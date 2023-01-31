<?php

namespace App\Entity;

use App\Repository\InvitacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitacionRepository::class)]
class Invitacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'invitaciones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $socio = null;

    #[ORM\OneToOne(inversedBy: 'invitacion', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Evento $evento = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEvento(): ?Evento
    {
        return $this->evento;
    }

    public function setEvento(Evento $evento): self
    {
        $this->evento = $evento;

        return $this;
    }
}
