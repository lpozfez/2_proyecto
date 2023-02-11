<?php

namespace App\Entity;

use App\Repository\JuegoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegoRepository::class)]
class Juego
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 150)]
    private ?string $editorial = null;

    #[ORM\Column]
    private ?int $minJugadores = null;

    #[ORM\Column]
    private ?int $maxJugadores = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $anchoTablero = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $altoTablero = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imagen = null;

    #[ORM\OneToMany(mappedBy: 'juego', targetEntity: Reserva::class, orphanRemoval: true)]
    private Collection $reservas;

    #[ORM\OneToMany(mappedBy: 'juego', targetEntity: EventoPresentaJuego::class, orphanRemoval: true)]
    private Collection $eventoPresentaJuegos;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
        $this->eventoPresentaJuegos = new ArrayCollection();
    }

    /*
    public function __construct($nombre, $editorial, $minJugadores, $maxJugadores, $anchoTab, $altoTab, $imagen)
    {
        $this->nombre=$nombre;
        $this->editorial=$editorial;
        $this->minJugadores=$minJugadores;
        $this->maxJugadores=$maxJugadores;
        $this->anchoTablero=$anchoTab;
        $this->altoTablero=$altoTab;
        $this->imagen=$imagen;
    }*/

    public function toArray() 
    { 
        return [ 
            'id' => $this->getId(), 
            'nombre' => $this->getNombre(), 
            'editorial' => $this->getEditorial(), 
            'minJugadores' => $this->getMinJugadores(),
            'maxJugadores' => $this->getMaxJugadores(),
            'anchoTablero' => $this->getAnchoTablero(), 
            'altoTablero' => $this->getAltoTablero(),
            'imagen' => $this->getImagen() 
        ]; 
    }

//GETTER Y SETTERS

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

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }

    public function getMinJugadores(): ?int
    {
        return $this->minJugadores;
    }

    public function setMinJugadores(int $minJugadores): self
    {
        $this->minJugadores = $minJugadores;

        return $this;
    }

    public function getMaxJugadores(): ?int
    {
        return $this->maxJugadores;
    }

    public function setMaxJugadores(int $maxJugadores): self
    {
        $this->maxJugadores = $maxJugadores;

        return $this;
    }

    public function getAnchoTablero(): ?string
    {
        return $this->anchoTablero;
    }

    public function setAnchoTablero(string $anchoTablero): self
    {
        $this->anchoTablero = $anchoTablero;

        return $this;
    }

    public function getAltoTablero(): ?string
    {
        return $this->altoTablero;
    }

    public function setAltoTablero(string $altoTablero): self
    {
        $this->altoTablero = $altoTablero;

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
            $reserva->setJuego($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getJuego() === $this) {
                $reserva->setJuego(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EventoPresentaJuego>
     */
    public function getEventoPresentaJuegos(): Collection
    {
        return $this->eventoPresentaJuegos;
    }

    public function addEventoPresentaJuego(EventoPresentaJuego $eventoPresentaJuego): self
    {
        if (!$this->eventoPresentaJuegos->contains($eventoPresentaJuego)) {
            $this->eventoPresentaJuegos->add($eventoPresentaJuego);
            $eventoPresentaJuego->setJuego($this);
        }

        return $this;
    }

    public function removeEventoPresentaJuego(EventoPresentaJuego $eventoPresentaJuego): self
    {
        if ($this->eventoPresentaJuegos->removeElement($eventoPresentaJuego)) {
            // set the owning side to null (unless already changed)
            if ($eventoPresentaJuego->getJuego() === $this) {
                $eventoPresentaJuego->setJuego(null);
            }
        }

        return $this;
    }
}
