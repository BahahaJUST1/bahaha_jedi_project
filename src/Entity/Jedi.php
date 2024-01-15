<?php

namespace App\Entity;

use App\Repository\JediRepository;
use App\Enum\Status;
use App\Entity\UtilisateurForce;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JediRepository::class)]
class Jedi extends UtilisateurForce
{
    #[ORM\Column]
    private ?Status $status = Status::chevalier;

    #[ORM\Column]
    private ?string $image = null;

    #[ORM\OneToOne(inversedBy: 'maitre', cascade: ['persist', 'remove'])]
    private ?Padawan $padawan = null;

    #[ORM\ManyToOne(inversedBy: 'generaux')]
    private ?Legion $legion = null;

    #[ORM\ManyToMany(targetEntity: Guerre::class, inversedBy: 'combattants')]
    private Collection $guerres;

    public function __construct()
    {
        $this->guerres = new ArrayCollection();
    }

    public function getStatus(): ?string
    {
        return $this->status->value;
    }

    public function setStatus(Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPadawan(): ?padawan
    {
        return $this->padawan;
    }

    public function setPadawan(?padawan $padawan): static
    {
        $this->padawan = $padawan;

        return $this;
    }

    public function getLegion(): ?legion
    {
        return $this->legion;
    }

    public function setLegion(?legion $legion): static
    {
        $this->legion = $legion;

        return $this;
    }

    /**
     * @return Collection<int, guerre>
     */
    public function getGuerres(): Collection
    {
        return $this->guerres;
    }

    public function addGuerre(guerre $guerre): static
    {
        if (!$this->guerres->contains($guerre)) {
            $this->guerres->add($guerre);
        }

        return $this;
    }

    public function removeGuerre(guerre $guerre): static
    {
        $this->guerres->removeElement($guerre);

        return $this;
    }
}
