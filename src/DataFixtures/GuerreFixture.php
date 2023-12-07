<?php

namespace App\DataFixtures;

use App\Entity\Guerre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GuerreFixture extends Fixture
{
    private const GUERRE_REFERENCE = 'Guerre';

    public function load(ObjectManager $manager): void
    {
        $nomsGuerres = [
            "Christophsis",
            "Kamino",
            "Geonosis",
            "Umbara",
            "Utapau",
            "Mandalore",
            "Ryloth",
            "Felucia",
            "Abregado",
            "Lola Sayu",
            "Coruscant"
        ];

        foreach ($nomsGuerres as $key => $nomGuerre) {
            $guerre = new Guerre();
            $guerre->setPlanete($nomGuerre);
            $manager->persist($guerre);
            $this->addReference(self::GUERRE_REFERENCE . '_' . $key, $guerre);
        }

        $manager->flush();
    }
}
