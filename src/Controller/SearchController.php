<?php

namespace App\Controller;

use App\Entity\Job;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class SearchController extends AbstractController
{
    #[Route(
        path: "/search",
        name: "search",
        defaults: [
            "_api_resource_class" => Job::class,
            "_api_collection_operation_name" => "get",
            "_api_receive" => false,
        ],
        methods: ["GET"],
    )]

    public function __invoke(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
		//internal data
		$repository = $entityManager->getRepository(Job::class);

		$filters = $request->query->all();

		unset($filters["page"]);

		$queryBuilder = $repository->createQueryBuilder("j");

		if(!empty($filters["name"]))
		{
			$queryBuilder->andWhere("j.name like :name")->setParameter("name", "%" . $filters["name"] . "%");
		}

		if(!empty($filters["country"]))
		{
			$queryBuilder->andWhere("j.country = :country")->setParameter("country", $filters["country"]);
		}

		// Apply range filter
		if(!empty($filters["salary"]))
		{
			if(!empty($filters["salary"]["gte"]))
			{
				$queryBuilder->andWhere("j.salary >= :min_salary")->setParameter("min_salary", $filters["salary"]["gte"]);
			}

			if(!empty($filters["salary"]["lte"]))
			{
				$queryBuilder->andWhere("j.salary <= :max_salary")->setParameter("max_salary", $filters["salary"]["lte"]);
			}
		}

		$internalJobs = $queryBuilder->getQuery()->getResult();

		// external data (JobberwockyExteneralJobs)
		$externalJobs = [];

		$httpClient = HttpClient::create();

		try
		{
			$queryString = http_build_query($filters);

			$queryString = str_replace("salary%5Bgte%5D", "salary_min", $queryString);
			$queryString = str_replace("salary%5Blte%5D", "salary_max", $queryString);

			$response = $httpClient->request("GET", "http://127.0.0.1:8080/jobs?{$queryString}");

			$statusCode = $response->getStatusCode();

			if($statusCode === 200)
			{
				$jobberwockyJobs = $response->toArray();

				if(!empty($jobberwockyJobs))
				{
					foreach($jobberwockyJobs as $job)
					{
						$externalJobs[] = [
							"name" => $job[0],
							"salary" => $job[1],
							"country" => $job[2],
							"skills" => $job[3]
						];
					}
				}
			}
			else
			{
				// log error
			}
		}
		catch(\Exception $e)
		{
			// log error
		}

		$data = array_merge($internalJobs, $externalJobs);

		return new JsonResponse($data);
	}
}
