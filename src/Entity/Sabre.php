<?php

namespace App\Entity;

use App\Repository\SabreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SabreRepository::class)]
class Sabre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    #[ORM\Column]
    private ?bool $bi_lame = null;

    #[ORM\ManyToOne(inversedBy: 'sabres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?UtilisateurForce $proprietaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function isBiLame(): ?bool
    {
        return $this->bi_lame;
    }

    public function setBiLame(bool $bi_lame): static
    {
        $this->bi_lame = $bi_lame;

        return $this;
    }

    public function getProprietaire(): ?UtilisateurForce
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?UtilisateurForce $proprietaire): static
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }
}
