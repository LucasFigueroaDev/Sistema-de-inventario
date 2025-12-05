<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Roles $role = null;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?Sessions $sessions = null;

    #[ORM\OneToOne(mappedBy: 'user_id', cascade: ['persist', 'remove'])]
    private ?AuditLogs $auditLogs = null;

    /**
     * @var Collection<int, StockMovements>
     */
    #[ORM\OneToMany(targetEntity: StockMovements::class, mappedBy: 'user_id')]
    private Collection $stockMovements;

    /**
     * @var Collection<int, WarehouseTransfers>
     */
    #[ORM\OneToMany(targetEntity: WarehouseTransfers::class, mappedBy: 'user_id')]
    private Collection $warehouseTransfers;

    /**
     * @var Collection<int, Purchases>
     */
    #[ORM\OneToMany(targetEntity: Purchases::class, mappedBy: 'user_id')]
    private Collection $purchases;

    /**
     * @var Collection<int, Sales>
     */
    #[ORM\OneToMany(targetEntity: Sales::class, mappedBy: 'user_id')]
    private Collection $sales;

    /**
     * @var Collection<int, UserNotifications>
     */
    #[ORM\OneToMany(targetEntity: UserNotifications::class, mappedBy: 'user_id')]
    private Collection $userNotifications;

    /**
     * @var Collection<int, Tickets>
     */
    #[ORM\OneToMany(targetEntity: Tickets::class, mappedBy: 'user_id')]
    private Collection $tickets;

    /**
     * @var Collection<int, TicketMessages>
     */
    #[ORM\OneToMany(targetEntity: TicketMessages::class, mappedBy: 'user_id')]
    private Collection $ticketMessages;

    /**
     * @var Collection<int, Carts>
     */
    #[ORM\OneToMany(targetEntity: Carts::class, mappedBy: 'user_id')]
    private Collection $carts;

    public function __construct()
    {
        $this->stockMovements = new ArrayCollection();
        $this->warehouseTransfers = new ArrayCollection();
        $this->purchases = new ArrayCollection();
        $this->sales = new ArrayCollection();
        $this->userNotifications = new ArrayCollection();
        $this->tickets = new ArrayCollection();
        $this->ticketMessages = new ArrayCollection();
        $this->carts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

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

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getSessions(): ?Sessions
    {
        return $this->sessions;
    }

    public function setSessions(Sessions $sessions): static
    {
        // set the owning side of the relation if necessary
        if ($sessions->getUserId() !== $this) {
            $sessions->setUserId($this);
        }

        $this->sessions = $sessions;

        return $this;
    }

    public function getAuditLogs(): ?AuditLogs
    {
        return $this->auditLogs;
    }

    public function setAuditLogs(AuditLogs $auditLogs): static
    {
        // set the owning side of the relation if necessary
        if ($auditLogs->getUserId() !== $this) {
            $auditLogs->setUserId($this);
        }

        $this->auditLogs = $auditLogs;

        return $this;
    }

    /**
     * @return Collection<int, StockMovements>
     */
    public function getStockMovements(): Collection
    {
        return $this->stockMovements;
    }

    public function addStockMovement(StockMovements $stockMovement): static
    {
        if (!$this->stockMovements->contains($stockMovement)) {
            $this->stockMovements->add($stockMovement);
            $stockMovement->setUserId($this);
        }

        return $this;
    }

    public function removeStockMovement(StockMovements $stockMovement): static
    {
        if ($this->stockMovements->removeElement($stockMovement)) {
            // set the owning side to null (unless already changed)
            if ($stockMovement->getUserId() === $this) {
                $stockMovement->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WarehouseTransfers>
     */
    public function getWarehouseTransfers(): Collection
    {
        return $this->warehouseTransfers;
    }

    public function addWarehouseTransfer(WarehouseTransfers $warehouseTransfer): static
    {
        if (!$this->warehouseTransfers->contains($warehouseTransfer)) {
            $this->warehouseTransfers->add($warehouseTransfer);
            $warehouseTransfer->setUserId($this);
        }

        return $this;
    }

    public function removeWarehouseTransfer(WarehouseTransfers $warehouseTransfer): static
    {
        if ($this->warehouseTransfers->removeElement($warehouseTransfer)) {
            // set the owning side to null (unless already changed)
            if ($warehouseTransfer->getUserId() === $this) {
                $warehouseTransfer->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Purchases>
     */
    public function getPurchases(): Collection
    {
        return $this->purchases;
    }

    public function addPurchase(Purchases $purchase): static
    {
        if (!$this->purchases->contains($purchase)) {
            $this->purchases->add($purchase);
            $purchase->setUserId($this);
        }

        return $this;
    }

    public function removePurchase(Purchases $purchase): static
    {
        if ($this->purchases->removeElement($purchase)) {
            // set the owning side to null (unless already changed)
            if ($purchase->getUserId() === $this) {
                $purchase->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sales>
     */
    public function getSales(): Collection
    {
        return $this->sales;
    }

    public function addSale(Sales $sale): static
    {
        if (!$this->sales->contains($sale)) {
            $this->sales->add($sale);
            $sale->setUserId($this);
        }

        return $this;
    }

    public function removeSale(Sales $sale): static
    {
        if ($this->sales->removeElement($sale)) {
            // set the owning side to null (unless already changed)
            if ($sale->getUserId() === $this) {
                $sale->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserNotifications>
     */
    public function getUserNotifications(): Collection
    {
        return $this->userNotifications;
    }

    public function addUserNotification(UserNotifications $userNotification): static
    {
        if (!$this->userNotifications->contains($userNotification)) {
            $this->userNotifications->add($userNotification);
            $userNotification->setUserId($this);
        }

        return $this;
    }

    public function removeUserNotification(UserNotifications $userNotification): static
    {
        if ($this->userNotifications->removeElement($userNotification)) {
            // set the owning side to null (unless already changed)
            if ($userNotification->getUserId() === $this) {
                $userNotification->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tickets>
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Tickets $ticket): static
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets->add($ticket);
            $ticket->setUserId($this);
        }

        return $this;
    }

    public function removeTicket(Tickets $ticket): static
    {
        if ($this->tickets->removeElement($ticket)) {
            // set the owning side to null (unless already changed)
            if ($ticket->getUserId() === $this) {
                $ticket->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, TicketMessages>
     */
    public function getTicketMessages(): Collection
    {
        return $this->ticketMessages;
    }

    public function addTicketMessage(TicketMessages $ticketMessage): static
    {
        if (!$this->ticketMessages->contains($ticketMessage)) {
            $this->ticketMessages->add($ticketMessage);
            $ticketMessage->setUserId($this);
        }

        return $this;
    }

    public function removeTicketMessage(TicketMessages $ticketMessage): static
    {
        if ($this->ticketMessages->removeElement($ticketMessage)) {
            // set the owning side to null (unless already changed)
            if ($ticketMessage->getUserId() === $this) {
                $ticketMessage->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Carts>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Carts $cart): static
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->setUserId($this);
        }

        return $this;
    }

    public function removeCart(Carts $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            // set the owning side to null (unless already changed)
            if ($cart->getUserId() === $this) {
                $cart->setUserId(null);
            }
        }

        return $this;
    }
}
