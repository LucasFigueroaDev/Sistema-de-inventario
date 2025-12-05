<?php

namespace App\Entity;

use App\Repository\WarehouseTransfersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: WarehouseTransfersRepository::class)]
#[Broadcast]
class WarehouseTransfers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'warehouseTransfers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Products $product_id = null;

    #[ORM\ManyToOne(inversedBy: 'warehouseTransfers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Warehouses $from_warehouse = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'warehouseTransfers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?Products
    {
        return $this->product_id;
    }

    public function setProductId(?Products $product_id): static
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getFromWarehouse(): ?Warehouses
    {
        return $this->from_warehouse;
    }

    public function setFromWarehouse(?Warehouses $from_warehouse): static
    {
        $this->from_warehouse = $from_warehouse;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

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
