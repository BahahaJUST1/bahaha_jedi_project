<?php

namespace App\Entity;

use App\Repository\GuerreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuerreRepository::class)]
class Guerre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $planete = null;

    #[ORM\ManyToMany(targetEntity: Jedi::class, mappedBy: 'guerres')]
    private Collection $combattants;

    public function __construct()
    {
        $this->combattants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlanete(): ?string
    {
        return $this->planete;
    }

    public function setPlanete(string $planete): static
    {
        $this->planete = $planete;

        return $this;
    }

    /**
     * @return Collection<int, Jedi>
     */
    public function getCombattants(): Collection
    {
        return $this->combattants;
    }

    public function addCombattant(Jedi $combattant): static
    {
        if (!$this->combattants->contains($combattant)) {
            $this->combattants->add($combattant);
            $combattant->addGuerre($this);
        }

        return $this;
    }

    public function removeCombattant(Jedi $combattant): static
    {
        if ($this->combattants->removeElement($combattant)) {
            $combattant->removeGuerre($this);
        }

        return $this;
    }
}
