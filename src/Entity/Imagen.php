<?php

namespace App\Entity;

use App\Repository\ImagenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagenRepository::class)]
class Imagen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Productos>
     */
    #[ORM\ManyToMany(targetEntity: Productos::class, inversedBy: 'imagens')]
    private Collection $producto;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    public function __construct()
    {
        $this->producto = new ArrayCollection();
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

    /**
     * @return Collection<int, Productos>
     */
    public function getProducto(): Collection
    {
        return $this->producto;
    }

    public function addProducto(Productos $producto): static
    {
        if (!$this->producto->contains($producto)) {
            $this->producto->add($producto);
        }

        return $this;
    }

    public function removeProducto(Productos $producto): static
    {
        $this->producto->removeElement($producto);

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }
}
