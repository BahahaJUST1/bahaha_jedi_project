<?php

namespace App\DataFixtures;

use App\Entity\Jedi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JediFixture extends Fixture
{
    private const JEDI_REFERENCE = 'Jedi';

    public function load(ObjectManager $manager): void
    {
        $noms = [
            "Maul",
            "Krell",
            "Skywalker",
            "Kenobi",
            "Jinn",
            "Windu"
        ];

        $prenoms = [
            "Dark",
            "Pong",
            "Anakin",
            "Obi-Wan",
            "Qui-Gon",
            "Mace"
        ];

        for ($i = 0; $i < count($noms); $i++ ) {
            $jedi = new Jedi();
            $jedi->setNom($noms[$i]);
            $jedi->setPrenom($prenoms[$i]);
            $manager->persist($jedi);
            $this->addReference(self::JEDI_REFERENCE . '_' . $i, $jedi);
        }

        $manager->flush();
    }
}
