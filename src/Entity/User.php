<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\Column(length: 150)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 50)]
    private ?string $nickname = null;

    #[ORM\Column(length: 260)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $contraseña = null;

    #[ORM\Column(length: 5)]
    private ?string $rol = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $telegram = null;

    #[ORM\Column(nullable: true)]
    private ?int $puntos = null;

    #[ORM\OneToMany(mappedBy: 'socio', targetEntity: Reserva::class)]
    private Collection $reservas;

    #[ORM\OneToMany(mappedBy: 'socio', targetEntity: Invitacion::class, orphanRemoval: true)]
    private Collection $invitaciones;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
        $this->invitaciones = new ArrayCollection();
    }

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getContraseña(): ?string
    {
        return $this->contraseña;
    }

    public function setContraseña(string $contraseña): self
    {
        $this->contraseña = $contraseña;

        return $this;
    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(string $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    public function getTelegram(): ?string
    {
        return $this->telegram;
    }

    public function setTelegram(?string $telegram): self
    {
        $this->telegram = $telegram;

        return $this;
    }

    public function getPuntos(): ?int
    {
        return $this->puntos;
    }

    public function setPuntos(?int $puntos): self
    {
        $this->puntos = $puntos;

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
            $reserva->setSocio($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getSocio() === $this) {
                $reserva->setSocio(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Invitacion>
     */
    public function getInvitaciones(): Collection
    {
        return $this->invitaciones;
    }

    public function addInvitacione(Invitacion $invitacione): self
    {
        if (!$this->invitaciones->contains($invitacione)) {
            $this->invitaciones->add($invitacione);
            $invitacione->setSocio($this);
        }

        return $this;
    }

    public function removeInvitacione(Invitacion $invitacione): self
    {
        if ($this->invitaciones->removeElement($invitacione)) {
            // set the owning side to null (unless already changed)
            if ($invitacione->getSocio() === $this) {
                $invitacione->setSocio(null);
            }
        }

        return $this;
    }
}
