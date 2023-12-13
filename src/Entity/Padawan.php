<?php

namespace App\Entity;

use App\Repository\PadawanRepository;
use App\Entity\UtilisateurForce;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PadawanRepository::class)]
class Padawan extends UtilisateurForce
{
    #[ORM\OneToOne(mappedBy: 'padawan', cascade: ['persist', 'remove'])]
    private ?Jedi $maitre = null;

    public function getMaitre(): ?Jedi
    {
        return $this->maitre;
    }

    public function setMaitre(?Jedi $maitre): static
    {
        // unset the owning side of the relation if necessary
        if ($maitre === null && $this->maitre !== null) {
            $this->maitre->setPadawan(null);
        }

        // set the owning side of the relation if necessary
        if ($maitre !== null && $maitre->getPadawan() !== $this) {
            $maitre->setPadawan($this);
        }

        $this->maitre = $maitre;

        return $this;
    }
}
