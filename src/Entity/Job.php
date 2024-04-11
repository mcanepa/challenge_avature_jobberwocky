<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
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

	#[ORM\Column(type: Types::TEXT)]
	#[Assert\NotBlank]
	public string $description = "";

	#[ORM\Column(type: Types::INTEGER)]
	#[Assert\NotBlank]
	public int $salary = 0;

	#[ORM\Column]
	#[Assert\NotBlank]
	public string $country = "";

	#[ORM\Column(type: Types::JSON)]
	#[Assert\NotBlank]
	#[Assert\Json]
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

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}

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
