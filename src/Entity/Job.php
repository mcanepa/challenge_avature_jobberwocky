<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\SearchController;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[Delete]
#[Get]
#[GetCollection]
#[Patch]
#[Post]
#[Put]
#[GetCollection(
	name: "search",
	uriTemplate: "/search",
	controller: SearchController::class
)]
#[ApiFilter(RangeFilter::class, properties: ["salary"])]
#[ApiFilter(SearchFilter::class, properties: ["name" => "partial", "description" => "partial", "country" => "exact", "skills" => "partial"])]
#[ORM\Entity]
class Job
{
	#[ORM\Id]
	#[ORM\Column(type: "integer")]
	#[ORM\GeneratedValue]
	private ?int $id = null;

	#[ORM\Column]
	#[Assert\NotBlank]
	public string $name = "";

	// #[ORM\Column(type: Types::TEXT)]
	// #[Assert\NotBlank]
	// public string $description = "";

	#[ORM\Column(type: Types::INTEGER)]
	#[Assert\NotBlank]
	public int $salary = 0;

	#[ORM\Column]
	#[Assert\NotBlank]
	public string $country = "";

	#[ORM\Column(type: Types::JSON)]
	#[Assert\NotBlank]
	public array $skills = [];

	#[ORM\ManyToOne(targetEntity: User::class, inversedBy: "jobs")]
	private $user;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	// public function getDescription()
	// {
	// 	return $this->description;
	// }

	// public function setDescription($description)
	// {
	// 	$this->description = $description;

	// 	return $this;
	// }

	public function getSalary()
	{
		return $this->salary;
	}

	public function setSalary($salary)
	{
		$this->salary = $salary;

		return $this;
	}

	public function getCountry()
	{
		return $this->country;
	}

	public function setCountry($country)
	{
		$this->country = $country;

		return $this;
	}

	public function getSkills()
	{
		return $this->skills;
	}

	public function setSkills($skills)
	{
		$this->skills = $skills;

		return $this;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;

		return $this;
	}
}
