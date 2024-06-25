<?php

namespace App\Entity;

use App\Repository\TemporadasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemporadasRepository::class)]
class Temporadas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Productos>
     */
    #[ORM\ManyToMany(targetEntity: Productos::class, inversedBy: 'temporadas')]
    private Collection $Productos;

    public function __construct()
    {
        $this->Productos = new ArrayCollection();
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Productos>
     */
    public function getProductos(): Collection
    {
        return $this->Productos;
    }

    public function addProducto(Productos $producto): static
    {
        if (!$this->Productos->contains($producto)) {
            $this->Productos->add($producto);
        }

        return $this;
    }

    public function removeProducto(Productos $producto): static
    {
        $this->Productos->removeElement($producto);

        return $this;
    }
}
