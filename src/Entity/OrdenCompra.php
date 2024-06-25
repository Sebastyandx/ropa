<?php

namespace App\Entity;

use App\Repository\OrdenCompraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdenCompraRepository::class)]
class OrdenCompra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ordenCompras')]
    private ?User $user = null;

    #[ORM\Column(nullable: true)]
    private ?float $precio = null;

    /**
     * @var Collection<int, ItemCarrito>
     */
    #[ORM\OneToMany(targetEntity: ItemCarrito::class, mappedBy: 'ordenCompra')]
    private Collection $itemCarrito_id;

    public function __construct()
    {
        $this->itemCarrito_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(?float $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * @return Collection<int, ItemCarrito>
     */
    public function getItemCarritoId(): Collection
    {
        return $this->itemCarrito_id;
    }

    public function addItemCarritoId(ItemCarrito $itemCarritoId): static
    {
        if (!$this->itemCarrito_id->contains($itemCarritoId)) {
            $this->itemCarrito_id->add($itemCarritoId);
            $itemCarritoId->setOrdenCompra($this);
        }

        return $this;
    }

    public function removeItemCarritoId(ItemCarrito $itemCarritoId): static
    {
        if ($this->itemCarrito_id->removeElement($itemCarritoId)) {
            // set the owning side to null (unless already changed)
            if ($itemCarritoId->getOrdenCompra() === $this) {
                $itemCarritoId->setOrdenCompra(null);
            }
        }

        return $this;
    }
}
