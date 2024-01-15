<?php

namespace App\DataFixtures;

use App\Enum\Status;
use App\Entity\Jedi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class JediFixture extends Fixture implements DependentFixtureInterface
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
            "obi-Wan",
            "Qui-Gon",
            "Mace"
        ];

        $status = [
            Status::sith,
            Status::chevalier,
            Status::chevalier,
            Status::maitre,
            Status::maitre,
            Status::maitre
        ];

        $images = [
            "https://styles.redditmedia.com/t5_2z365/styles/communityIcon_82x82wngtto41.png",
            "https://image.noelshack.com/fichiers/2024/03/1/1705316180-pong-krell.png",
            "https://pbs.twimg.com/profile_images/625047088770994176/Zjux18Dq_400x400.jpg",
            "https://d26oc3sg82pgk3.cloudfront.net/files/media/edit/image/33482/square_thumb%402x.jpg",
            "https://image.noelshack.com/fichiers/2024/03/1/1705316404-qui-gon-jinn-headshot-tpm.jpg",
            "https://pbs.twimg.com/profile_images/711256696526651392/S_wF4PAv_400x400.jpg"
        ];

        $padawans = [
            "Padawan_1",
            null,
            "Padawan_0",
            null,
            null,
            null
        ];

        $legions = [
            null,
            "Legion_501",
            "Legion_501",
            "Legion_212",
            null,
            null
        ];

        $guerres = [
            ["Guerre_5"],
            ["Guerre_3"],
            ["Guerre_0", "Guerre_2", "Guerre_3", "Guerre_8", "Guerre_9", "Guerre_10"],
            ["Guerre_0", "Guerre_2", "Guerre_4", "Guerre_6", "Guerre_9", "Guerre_10"],
            null,
            ["Guerre_2", "Guerre_6", "Guerre_10"],
        ];

        for ($i = 0; $i < count($noms); $i++ ) {
            $jedi = new Jedi();
            $jedi->setStatus($status[$i]);
            $jedi->setImage($images[$i]);
            $jedi->setNom($noms[$i]);
            $jedi->setPrenom($prenoms[$i]);
            $padawans[$i] == null ? $jedi->setPadawan($padawans[$i]) : $jedi->setPadawan($this->getReference($padawans[$i]));
            $legions[$i] == null ? $jedi->setLegion($legions[$i]) : $jedi->setLegion($this->getReference($legions[$i]));
            
            if ($guerres[$i] != null) {
                
                foreach ($guerres[$i] as $guerre) {
                    $jedi->addGuerre($this->getReference($guerre));
                }
            }

            $manager->persist($jedi);
            $this->addReference(self::JEDI_REFERENCE . '_' . $i, $jedi);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PadawanFixture::class,
            LegionCloneFixture::class
        ];
    }
}
