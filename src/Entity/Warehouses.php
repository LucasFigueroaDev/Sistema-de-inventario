<?php

namespace App\Entity;

use App\Repository\WarehousesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: WarehousesRepository::class)]
#[Broadcast]
class Warehouses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    /**
     * @var Collection<int, Stock>
     */
    #[ORM\OneToMany(targetEntity: Stock::class, mappedBy: 'warehouse_id')]
    private Collection $stocks;

    /**
     * @var Collection<int, StockMovements>
     */
    #[ORM\OneToMany(targetEntity: StockMovements::class, mappedBy: 'warehouse_id')]
    private Collection $stockMovements;

    /**
     * @var Collection<int, WarehouseTransfers>
     */
    #[ORM\OneToMany(targetEntity: WarehouseTransfers::class, mappedBy: 'from_warehouse')]
    private Collection $warehouseTransfers;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->stockMovements = new ArrayCollection();
        $this->warehouseTransfers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): static
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks->add($stock);
            $stock->setWarehouseId($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getWarehouseId() === $this) {
                $stock->setWarehouseId(null);
            }
        }

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
            $stockMovement->setWarehouseId($this);
        }

        return $this;
    }

    public function removeStockMovement(StockMovements $stockMovement): static
    {
        if ($this->stockMovements->removeElement($stockMovement)) {
            // set the owning side to null (unless already changed)
            if ($stockMovement->getWarehouseId() === $this) {
                $stockMovement->setWarehouseId(null);
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
            $warehouseTransfer->setFromWarehouse($this);
        }

        return $this;
    }

    public function removeWarehouseTransfer(WarehouseTransfers $warehouseTransfer): static
    {
        if ($this->warehouseTransfers->removeElement($warehouseTransfer)) {
            // set the owning side to null (unless already changed)
            if ($warehouseTransfer->getFromWarehouse() === $this) {
                $warehouseTransfer->setFromWarehouse(null);
            }
        }

        return $this;
    }
}
