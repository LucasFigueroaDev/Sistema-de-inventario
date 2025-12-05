<?php

namespace App\Entity;

use App\Repository\TicketMessagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: TicketMessagesRepository::class)]
#[Broadcast]
class TicketMessages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Tickets>
     */
    #[ORM\OneToMany(targetEntity: Tickets::class, mappedBy: 'ticketMessages')]
    private Collection $ticket_id;

    #[ORM\ManyToOne(inversedBy: 'ticketMessages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function __construct()
    {
        $this->ticket_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Tickets>
     */
    public function getTicketId(): Collection
    {
        return $this->ticket_id;
    }

    public function addTicketId(Tickets $ticketId): static
    {
        if (!$this->ticket_id->contains($ticketId)) {
            $this->ticket_id->add($ticketId);
            $ticketId->setTicketMessages($this);
        }

        return $this;
    }

    public function removeTicketId(Tickets $ticketId): static
    {
        if ($this->ticket_id->removeElement($ticketId)) {
            // set the owning side to null (unless already changed)
            if ($ticketId->getTicketMessages() === $this) {
                $ticketId->setTicketMessages(null);
            }
        }

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }
}
