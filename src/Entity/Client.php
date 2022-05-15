<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $clientName;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $billing;

    #[ORM\Column(type: 'string', length: 255)]
    private $paymentMethod;

    #[ORM\Column(type: 'text', nullable: true)]
    private $invoiceData;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avatarPath;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $avatarAlt;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Task::class)]
    #[ORM\OrderBy(["date" => "DESC"])]
    private $tasks;

    public function __construct() {
        $this->tasks = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getClientName(): ?string {
        return $this->clientName;
    }

    public function setClientName(string $clientName): self {
        $this->clientName = $clientName;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getBilling(): ?string {
        return $this->billing;
    }

    public function setBilling(string $billing): self {
        $this->billing = $billing;
        return $this;
    }

    public function getPaymentMethod(): ?string {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(string $paymentMethod): self {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getInvoiceData(): ?string {
        return $this->invoiceData;
    }

    public function setInvoiceData(?string $invoiceData): self {
        $this->invoiceData = $invoiceData;
        return $this;
    }

    public function getAvatarPath(): ?string {
        return $this->avatarPath;
    }

    public function setAvatarPath(?string $avatarPath): self {
        $this->avatarPath = $avatarPath;
        return $this;
    }

    public function getAvatarAlt(): ?string {
        return $this->avatarAlt;
    }

    public function setAvatarAlt(?string $avatarAlt): self {
        $this->avatarAlt = $avatarAlt;
        return $this;
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
            $task->setClient($this);
        }
        return $this;
    }

    public function removeTask(Task $task): self {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getClient() === $this) {
                $task->setClient(null);
            }
        }
        return $this;
    }
}