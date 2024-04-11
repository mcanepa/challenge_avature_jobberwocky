<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class Company
{
	#[ORM\Id]
	#[ORM\Column(type: "integer")]
	#[ORM\GeneratedValue]
	private ?int $id = null;

	#[ORM\Column]
	#[Assert\NotBlank]
	private string $name = "";

	#[ORM\OneToMany(targetEntity: User::class, mappedBy: "company")]
	private $users;

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

	public function getUsers()
	{
		return $this->users;
	}

	public function setUsers(Array $users)
	{
		$this->users = $users;

		return $this;
	}
}
