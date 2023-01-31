<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    #[ORM\OneToOne(mappedBy: 'evento', cascade: ['persist', 'remove'])]
    private ?Invitacion $invitacion = null;

    #[ORM\OneToOne(mappedBy: 'evento', cascade: ['persist', 'remove'])]
    private ?EventoPresentaJuego $eventoPresentaJuego = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getInvitacion(): ?Invitacion
    {
        return $this->invitacion;
    }

    public function setInvitacion(Invitacion $invitacion): self
    {
        // set the owning side of the relation if necessary
        if ($invitacion->getEvento() !== $this) {
            $invitacion->setEvento($this);
        }

        $this->invitacion = $invitacion;

        return $this;
    }

    public function getEventoPresentaJuego(): ?EventoPresentaJuego
    {
        return $this->eventoPresentaJuego;
    }

    public function setEventoPresentaJuego(EventoPresentaJuego $eventoPresentaJuego): self
    {
        // set the owning side of the relation if necessary
        if ($eventoPresentaJuego->getEvento() !== $this) {
            $eventoPresentaJuego->setEvento($this);
        }

        $this->eventoPresentaJuego = $eventoPresentaJuego;

        return $this;
    }
}
