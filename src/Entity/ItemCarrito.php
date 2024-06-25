<?php

namespace App\Entity;

use App\Repository\ItemCarritoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemCarritoRepository::class)]
class ItemCarrito
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cantidad = null;

    #[ORM\ManyToOne(inversedBy: 'itemCarritos')]
    private ?Productos $productoId = null;

    #[ORM\ManyToOne(inversedBy: 'itemCarrito_id')]
    private ?OrdenCompra $ordenCompra = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getProductoId(): ?Productos
    {
        return $this->productoId;
    }

    public function setProductoId(?Productos $productoId): static
    {
        $this->productoId = $productoId;

        return $this;
    }

    public function getOrdenCompra(): ?OrdenCompra
    {
        return $this->ordenCompra;
    }

    public function setOrdenCompra(?OrdenCompra $ordenCompra): static
    {
        $this->ordenCompra = $ordenCompra;

        return $this;
    }

}
