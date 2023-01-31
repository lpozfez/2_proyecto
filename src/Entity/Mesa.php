<?php

namespace App\Entity;

use App\Repository\MesaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MesaRepository::class)]
class Mesa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $ancho = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $alto = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $x = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2, nullable: true)]
    private ?string $y = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\OneToMany(mappedBy: 'mesa', targetEntity: Reserva::class, orphanRemoval: true)]
    private Collection $reservas;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAncho(): ?string
    {
        return $this->ancho;
    }

    public function setAncho(string $ancho): self
    {
        $this->ancho = $ancho;

        return $this;
    }

    public function getAlto(): ?string
    {
        return $this->alto;
    }

    public function setAlto(string $alto): self
    {
        $this->alto = $alto;

        return $this;
    }

    public function getX(): ?string
    {
        return $this->x;
    }

    public function setX(string $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?string
    {
        return $this->y;
    }

    public function setY(?string $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @return Collection<int, Reserva>
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas->add($reserva);
            $reserva->setMesa($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getMesa() === $this) {
                $reserva->setMesa(null);
            }
        }

        return $this;
    }
}
