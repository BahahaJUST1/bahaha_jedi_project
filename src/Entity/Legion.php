<?php

namespace App\Entity;

use App\Repository\LegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LegionRepository::class)]
class Legion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commandant = null;

    #[ORM\OneToMany(mappedBy: 'legion', targetEntity: Jedi::class)]
    private Collection $generaux;

    public function __construct()
    {
        $this->generaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCommandant(): ?string
    {
        return $this->commandant;
    }

    public function setCommandant(?string $commandant): static
    {
        $this->commandant = $commandant;

        return $this;
    }

    /**
     * @return Collection<int, Jedi>
     */
    public function getGeneraux(): Collection
    {
        return $this->generaux;
    }

    public function addGeneraux(Jedi $generaux): static
    {
        if (!$this->generaux->contains($generaux)) {
            $this->generaux->add($generaux);
            $generaux->setLegion($this);
        }

        return $this;
    }

    public function removeGeneraux(Jedi $generaux): static
    {
        if ($this->generaux->removeElement($generaux)) {
            // set the owning side to null (unless already changed)
            if ($generaux->getLegion() === $this) {
                $generaux->setLegion(null);
            }
        }

        return $this;
    }
}
