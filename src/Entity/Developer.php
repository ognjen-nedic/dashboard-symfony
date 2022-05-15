<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

// Credentials for developer example: lizard.king@universal.com | lawoman

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
#[ORM\Table('developer')]
class Developer implements UserInterface, PasswordAuthenticatedUserInterface {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;
    
    #[ORM\Column(type: 'string', length: 255)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255)]
    private $street;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'integer')]
    private $PTT;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $bankAccount;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avatarPath;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avatarAlt;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\OneToMany(mappedBy: 'developer', targetEntity: Task::class)]
    #[ORM\OrderBy(["date" => "DESC"])]
    private $tasks;

    public function __construct() {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getFirstName(): ?string {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self {
        $this->lastName = $lastName;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function setPhone(string $phone): self {
        $this->phone = $phone;
        return $this;
    }

    public function getStreet(): ?string {
        return $this->street;
    }

    public function setStreet(string $street): self {
        $this->street = $street;
        return $this;
    }

    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity(string $city): self {
        $this->city = $city;
        return $this;
    }

    public function getPTT(): ?int {
        return $this->PTT;
    }

    public function setPTT(int $PTT): self {
        $this->PTT = $PTT;
        return $this;
    }

    public function getCountry(): ?string {
        return $this->country;
    }

    public function setCountry(string $country): self {
        $this->country = $country;
        return $this;
    }    

    public function getBankAccount(): ?string {
        return $this->bankAccount;
    }

    public function setBankAccount(string $bankAccount): self {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    public function getAvatarPath(): ?string {
        return $this->avatarPath;
    }

    public function setAvatarPath(string $avatarPath): self {
        $this->avatarPath = $avatarPath;
        return $this;
    }

    public function getAvatarAlt(): ?string {
        return $this->avatarAlt;
    }

    public function setAvatarAlt(string $avatarAlt): self {
        $this->avatarAlt = $avatarAlt;
        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array {
        $roles = $this->roles;
        // adds Developer role to all instances of Developer Entity
        $roles[] = 'ROLE_DEVELOPER';
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self {
        $this->roles = $roles;
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials() {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection {
        return $this->tasks;
    }

    public function addTask(Task $task): self {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setDeveloper($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getDeveloper() === $this) {
                $task->setDeveloper(null);
            }
        }
        return $this;
    }
}