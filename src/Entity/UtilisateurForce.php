<?php

namespace App\Entity;

use App\Entity\Padawan;
use App\Entity\Jedi;
use App\Repository\UtilisateurForceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurForceRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap([
    'padawan' => Padawan::class,
    'jedi' => Jedi::class
])]
class UtilisateurForce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'proprietaire', targetEntity: Sabre::class)]
    private Collection $sabres;

    public function __construct()
    {
        $this->sabres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Sabre>
     */
    public function getSabres(): Collection
    {
        return $this->sabres;
    }

    public function addSabre(Sabre $sabre): static
    {
        if (!$this->sabres->contains($sabre)) {
            $this->sabres->add($sabre);
            $sabre->setProprietaire($this);
        }

        return $this;
    }

    public function removeSabre(Sabre $sabre): static
    {
        if ($this->sabres->removeElement($sabre)) {
            // set the owning side to null (unless already changed)
            if ($sabre->getProprietaire() === $this) {
                $sabre->setProprietaire(null);
            }
        }

        return $this;
    }
}
