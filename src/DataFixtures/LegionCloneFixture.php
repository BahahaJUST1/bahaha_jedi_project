<?php

namespace App\DataFixtures;

use App\Entity\Legion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LegionCloneFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $numerosLegions = [
            "501",
            "212",
            "104",
            "332",
            "41",
            "327",
            "21"
        ];

        $nomsCommandants = [
            "Rex",
            "Cody",
            "Wolffe",
            "Vaughn",
            "Gree",
            "Bly",
            "Bacara"
        ];

        for ($i = 0; $i < count($numerosLegions); $i++ ) {
            $legion = new Legion();
            $legion->setNumero($numerosLegions[$i]);
            $legion->setCommandant($nomsCommandants[$i]);
            $manager->persist($legion);
        }

        $manager->flush();
    }
}
