<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: ProductsRepository::class)]
#[Broadcast]
class Products
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $sku = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $cost = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $category_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTime $updated_at = null;

    /**
     * @var Collection<int, Stock>
     */
    #[ORM\OneToMany(targetEntity: Stock::class, mappedBy: 'product_id')]
    private Collection $stocks;

    /**
     * @var Collection<int, StockMovements>
     */
    #[ORM\OneToMany(targetEntity: StockMovements::class, mappedBy: 'product_id')]
    private Collection $stockMovements;

    /**
     * @var Collection<int, WarehouseTransfers>
     */
    #[ORM\OneToMany(targetEntity: WarehouseTransfers::class, mappedBy: 'product_id')]
    private Collection $warehouseTransfers;

    /**
     * @var Collection<int, PurchaseItems>
     */
    #[ORM\OneToMany(targetEntity: PurchaseItems::class, mappedBy: 'product_id')]
    private Collection $purchaseItems;

    /**
     * @var Collection<int, SaleItems>
     */
    #[ORM\OneToMany(targetEntity: SaleItems::class, mappedBy: 'product_id')]
    private Collection $saleItems;

    /**
     * @var Collection<int, CartItems>
     */
    #[ORM\OneToMany(targetEntity: CartItems::class, mappedBy: 'product_id')]
    private Collection $cartItems;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->stockMovements = new ArrayCollection();
        $this->warehouseTransfers = new ArrayCollection();
        $this->purchaseItems = new ArrayCollection();
        $this->saleItems = new ArrayCollection();
        $this->cartItems = new ArrayCollection();
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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->cost;
    }

    public function setCost(string $cost): static
    {
        $this->cost = $cost;

        return $this;
    }

    public function getCategoryId(): ?Categories
    {
        return $this->category_id;
    }

    public function setCategoryId(?Categories $category_id): static
    {
        $this->category_id = $category_id;

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

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): static
    {
        $this->updated_at = $updated_at;

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
            $stock->setProductId($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): static
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getProductId() === $this) {
                $stock->setProductId(null);
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
            $stockMovement->setProductId($this);
        }

        return $this;
    }

    public function removeStockMovement(StockMovements $stockMovement): static
    {
        if ($this->stockMovements->removeElement($stockMovement)) {
            // set the owning side to null (unless already changed)
            if ($stockMovement->getProductId() === $this) {
                $stockMovement->setProductId(null);
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
            $warehouseTransfer->setProductId($this);
        }

        return $this;
    }

    public function removeWarehouseTransfer(WarehouseTransfers $warehouseTransfer): static
    {
        if ($this->warehouseTransfers->removeElement($warehouseTransfer)) {
            // set the owning side to null (unless already changed)
            if ($warehouseTransfer->getProductId() === $this) {
                $warehouseTransfer->setProductId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PurchaseItems>
     */
    public function getPurchaseItems(): Collection
    {
        return $this->purchaseItems;
    }

    public function addPurchaseItem(PurchaseItems $purchaseItem): static
    {
        if (!$this->purchaseItems->contains($purchaseItem)) {
            $this->purchaseItems->add($purchaseItem);
            $purchaseItem->setProductId($this);
        }

        return $this;
    }

    public function removePurchaseItem(PurchaseItems $purchaseItem): static
    {
        if ($this->purchaseItems->removeElement($purchaseItem)) {
            // set the owning side to null (unless already changed)
            if ($purchaseItem->getProductId() === $this) {
                $purchaseItem->setProductId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SaleItems>
     */
    public function getSaleItems(): Collection
    {
        return $this->saleItems;
    }

    public function addSaleItem(SaleItems $saleItem): static
    {
        if (!$this->saleItems->contains($saleItem)) {
            $this->saleItems->add($saleItem);
            $saleItem->setProductId($this);
        }

        return $this;
    }

    public function removeSaleItem(SaleItems $saleItem): static
    {
        if ($this->saleItems->removeElement($saleItem)) {
            // set the owning side to null (unless already changed)
            if ($saleItem->getProductId() === $this) {
                $saleItem->setProductId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CartItems>
     */
    public function getCartItems(): Collection
    {
        return $this->cartItems;
    }

    public function addCartItem(CartItems $cartItem): static
    {
        if (!$this->cartItems->contains($cartItem)) {
            $this->cartItems->add($cartItem);
            $cartItem->setProductId($this);
        }

        return $this;
    }

    public function removeCartItem(CartItems $cartItem): static
    {
        if ($this->cartItems->removeElement($cartItem)) {
            // set the owning side to null (unless already changed)
            if ($cartItem->getProductId() === $this) {
                $cartItem->setProductId(null);
            }
        }

        return $this;
    }
}
