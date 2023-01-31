<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $socio = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Juego $juego = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mesa $mesa = null;

    #[ORM\Column(nullable: true)]
    private ?bool $asiste = null;

    #[ORM\Column(nullable: true)]
    private ?bool $cancelacion = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tramo $tramo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getSocio(): ?User
    {
        return $this->socio;
    }

    public function setSocio(?User $socio): self
    {
        $this->socio = $socio;

        return $this;
    }

    public function getJuego(): ?Juego
    {
        return $this->juego;
    }

    public function setJuego(?Juego $juego): self
    {
        $this->juego = $juego;

        return $this;
    }

    public function getMesa(): ?Mesa
    {
        return $this->mesa;
    }

    public function setMesa(?Mesa $mesa): self
    {
        $this->mesa = $mesa;

        return $this;
    }

    public function isAsiste(): ?bool
    {
        return $this->asiste;
    }

    public function setAsiste(?bool $asiste): self
    {
        $this->asiste = $asiste;

        return $this;
    }

    public function isCancelacion(): ?bool
    {
        return $this->cancelacion;
    }

    public function setCancelacion(bool $cancelacion): self
    {
        $this->cancelacion = $cancelacion;

        return $this;
    }

    public function getTramo(): ?Tramo
    {
        return $this->tramo;
    }

    public function setTramo(?Tramo $tramo): self
    {
        $this->tramo = $tramo;

        return $this;
    }
}
