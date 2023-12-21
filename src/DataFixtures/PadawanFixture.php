<?php

namespace App\DataFixtures;

use App\Entity\Padawan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PadawanFixture extends Fixture 
{
    private const PADAWAN_REFERENCE = 'Padawan';

    public function load(ObjectManager $manager): void
    {
        $noms = [
            "Tano",
            "opress"
        ];

        $prenoms = [
            "Ahsoka",
            "Savage"
        ];


        for ($i = 0; $i < count($noms); $i++ ) {
            $padawan = new Padawan();
            $padawan->setNom($noms[$i]);
            $padawan->setPrenom($prenoms[$i]);
            $manager->persist($padawan);
            $this->addReference(self::PADAWAN_REFERENCE . '_' . $i, $padawan);
        }

        $manager->flush();
    }
}
