<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ORM\Entity]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
	#[ORM\Id]
	#[ORM\Column(type: "integer")]
	#[ORM\GeneratedValue]
	private ?int $id = null;

	#[ORM\Column]
	#[Assert\NotBlank]
	private string $name = "";

	#[ORM\Column(length: 100, unique: true)]
	#[Assert\NotBlank]
	#[Assert\Email]
	private string $email = "";

	#[ORM\Column]
	#[Assert\NotBlank]
	private ?string $password = null;

	#[ORM\ManyToOne(targetEntity: Company::class, inversedBy: "users")]
	#[Assert\Valid]
	private $company;

	#[ORM\OneToMany(targetEntity: Job::class, mappedBy: "user")]
	#[Assert\Valid]
	private $jobs;

	#[ORM\Column(type: "json")]
	private array $roles = [];

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

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function setPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}

	public function getCompany()
	{
		return $this->company;
	}

	public function setCompany($company)
	{
		$this->company = $company;

		return $this;
	}

	public function getJobs()
	{
		return $this->jobs;
	}

	public function setJobs($jobs)
	{
		$this->jobs = $jobs;

		return $this;
	}

	public function getRoles(): array
	{
		$roles = $this->roles;

		// guarantee every user at least has ROLE_USER
		$roles[] = "ROLE_USER";

		return array_unique($roles);
	}

	public function setRoles(array $roles): static
	{
		$this->roles = $roles;

		return $this;
	}

	public function eraseCredentials(): void
	{
		// If you store any temporary, sensitive data on the user, clear it here
		// $this->plainPassword = null;
	}

	public function getUserIdentifier(): string
	{
		return (string) $this->name;
	}
}
