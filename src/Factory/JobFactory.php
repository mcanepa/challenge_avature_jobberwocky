<?php

namespace App\Factory;

use App\Entity\Job;
use Doctrine\ORM\EntityRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;
use function Zenstruck\Foundry\lazy;

/**
 * @extends ModelFactory<Job>
 *
 * @method        Job|Proxy                        create(array|callable $attributes = [])
 * @method static Job|Proxy                        createOne(array $attributes = [])
 * @method static Job|Proxy                        find(object|array|mixed $criteria)
 * @method static Job|Proxy                        findOrCreate(array $attributes)
 * @method static Job|Proxy                        first(string $sortedField = 'id')
 * @method static Job|Proxy                        last(string $sortedField = 'id')
 * @method static Job|Proxy                        random(array $attributes = [])
 * @method static Job|Proxy                        randomOrCreate(array $attributes = [])
 * @method static EntityRepository|RepositoryProxy repository()
 * @method static Job[]|Proxy[]                    all()
 * @method static Job[]|Proxy[]                    createMany(int $number, array|callable $attributes = [])
 * @method static Job[]|Proxy[]                    createSequence(iterable|callable $sequence)
 * @method static Job[]|Proxy[]                    findBy(array $attributes)
 * @method static Job[]|Proxy[]                    randomRange(int $min, int $max, array $attributes = [])
 * @method static Job[]|Proxy[]                    randomSet(int $number, array $attributes = [])
 */
final class JobFactory extends ModelFactory
{
	/**
	 * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
	 *
	 * @todo inject services if required
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
	 *
	 * @todo add your default values here
	 */
	protected function getDefaults(): array
	{
		return [
			"name" => self::faker()->sentence(5),
			"description" => self::faker()->text(),
			"user" => lazy(fn () => UserFactory::randomOrCreate()),
			// "salary" => self::faker()->numberBetween(1500, 4500),
			"salary" => self::faker()->randomElement([1500, 2000, 2500, 3000, 3500], 1),
			// "country" => self::faker()->country(),
			"country" => self::faker()->randomElement(["Argentina", "Uruguay", "Brasil", "Chile", "Mexico", "USA"], 1),
			"skills" => self::faker()->randomElements(["php", "javascript", "html", "css", "sql", "api", "json", "oop"], rand(1, 5))
		];
	}

	/**
	 * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
	 */
	protected function initialize(): self
	{
		return $this
			// ->afterInstantiate(function(Job $job): void {})
		;
	}

	protected static function getClass(): string
	{
		return Job::class;
	}
}
