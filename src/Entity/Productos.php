<?php

namespace App\Entity;

use App\Repository\ProductosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductosRepository::class)]
class Productos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0)]
    private ?string $precio = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\ManyToOne(inversedBy: 'Productos')]
    private ?Categoria $categoria = null;

    #[ORM\ManyToOne(inversedBy: 'productos')]
    private ?Generos $generos = null;

    /**
     * @var Collection<int, Colores>
     */
    #[ORM\ManyToMany(targetEntity: Colores::class, mappedBy: 'Productos')]
    private Collection $colores;

    /**
     * @var Collection<int, Temporadas>
     */
    #[ORM\ManyToMany(targetEntity: Temporadas::class, mappedBy: 'Productos')]
    private Collection $temporadas;

    /**
     * @var Collection<int, Imagen>
     */
    #[ORM\ManyToMany(targetEntity: Imagen::class, mappedBy: 'producto')]
    private Collection $imagens;

    /**
     * @var Collection<int, ItemCarrito>
     */
    #[ORM\OneToMany(targetEntity: ItemCarrito::class, mappedBy: 'productoId')]
    private Collection $itemCarritos;

    public function __construct($nombre = null, $descripcion = null, $precio = null, $imagen = null, $stock = null )
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->precio = $imagen;
        $this->precio = $stock;
        $this->colores = new ArrayCollection();
        $this->temporadas = new ArrayCollection();
        $this->imagens = new ArrayCollection();
        $this->itemCarritos = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->precio;
    }

    public function setPrecio(string $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): static
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getGeneros(): ?Generos
    {
        return $this->generos;
    }

    public function setGeneros(?Generos $generos): static
    {
        $this->generos = $generos;

        return $this;
    }

    /**
     * @return Collection<int, Colores>
     */
    public function getColores(): Collection
    {
        return $this->colores;
    }

    public function addColore(Colores $colore): static
    {
        if (!$this->colores->contains($colore)) {
            $this->colores->add($colore);
            $colore->addProducto($this);
        }

        return $this;
    }

    public function removeColore(Colores $colore): static
    {
        if ($this->colores->removeElement($colore)) {
            $colore->removeProducto($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Temporadas>
     */
    public function getTemporadas(): Collection
    {
        return $this->temporadas;
    }

    public function addTemporada(Temporadas $temporada): static
    {
        if (!$this->temporadas->contains($temporada)) {
            $this->temporadas->add($temporada);
            $temporada->addProducto($this);
        }

        return $this;
    }

    public function removeTemporada(Temporadas $temporada): static
    {
        if ($this->temporadas->removeElement($temporada)) {
            $temporada->removeProducto($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Imagen>
     */
    public function getImagens(): Collection
    {
        return $this->imagens;
    }

    public function addImagen(Imagen $imagen): static
    {
        if (!$this->imagens->contains($imagen)) {
            $this->imagens->add($imagen);
            $imagen->addProducto($this);
        }

        return $this;
    }

    public function removeImagen(Imagen $imagen): static
    {
        if ($this->imagens->removeElement($imagen)) {
            $imagen->removeProducto($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ItemCarrito>
     */
    public function getItemCarritos(): Collection
    {
        return $this->itemCarritos;
    }

    public function addItemCarrito(ItemCarrito $itemCarrito): static
    {
        if (!$this->itemCarritos->contains($itemCarrito)) {
            $this->itemCarritos->add($itemCarrito);
            $itemCarrito->setProductoId($this);
        }

        return $this;
    }

    public function removeItemCarrito(ItemCarrito $itemCarrito): static
    {
        if ($this->itemCarritos->removeElement($itemCarrito)) {
            // set the owning side to null (unless already changed)
            if ($itemCarrito->getProductoId() === $this) {
                $itemCarrito->setProductoId(null);
            }
        }

        return $this;
    }
}
