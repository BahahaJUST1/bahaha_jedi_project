<?php

namespace App\DataFixtures;

use App\DataFixtures\JediFixture;
use App\DataFixtures\PadawanFixture;
use App\Entity\Sabre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SabreFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $couleursSabresJedis = [
            "Rouge",
            "Noir",
            "Bleu",
            "Vert",
            "Bleu",
            "Bleu",
            "Vert",
            "Violet",
        ];

        $couleursSabresPadawans = [
            "Blanc",
            "Rouge"
        ];

        $doubleLamesJedis = [
            false,
            false,
            true,
            true,
            false,
            false,
            false,
            false
        ];

        $doubleLamesPadawans = [
            false,
            true
        ];

        // ATTRIBUTIONS JEDIS

        // Maul a 2 sabres
        for ($i = 0; $i < 2; $i++ ) {
            $sabre = new Sabre();
            $sabre->setCouleur($couleursSabresJedis[$i]);
            $sabre->setBiLame($doubleLamesJedis[$i]);
            $sabre->setProprietaire($this->getReference("Jedi_0"));
            $manager->persist($sabre);
        }

        // Krell a 2 sabres
        for ($i = 2; $i < 4; $i++ ) {
            $sabre = new Sabre();
            $sabre->setCouleur($couleursSabresJedis[$i]);
            $sabre->setBiLame($doubleLamesJedis[$i]);
            $sabre->setProprietaire($this->getReference("Jedi_1"));
            $manager->persist($sabre);
        }

        // reste des jedi
        for ($i = 4; $i < count($couleursSabresJedis); $i++ ) {
            $sabre = new Sabre();
            $sabre->setCouleur($couleursSabresJedis[$i]);
            $sabre->setBiLame($doubleLamesJedis[$i]);
            $sabre->setProprietaire($this->getReference("Jedi_".$i-2));
            $manager->persist($sabre);
        }

        // ATTRIBUTION PADAWANS
        for ($i = 0; $i < count($couleursSabresPadawans); $i++ ) {
            $sabre = new Sabre();
            $sabre->setCouleur($couleursSabresPadawans[$i]);
            $sabre->setBiLame($doubleLamesPadawans[$i]);
            $sabre->setProprietaire($this->getReference("Padawan_".$i));
            $manager->persist($sabre);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PadawanFixture::class,
            JediFixture::class
        ];
    }
}
