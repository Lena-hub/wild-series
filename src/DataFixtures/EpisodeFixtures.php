<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\DataFixtures\SeasonFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public const EPISODE = [

        ['Episode 1' , 1, ],
        ['Episode 2' , 2, ],
        ['Episode 3' , 3, ],
        ['Episode 4' , 4, ],
        ['Episode 5' , 5, ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODE as $episodeNumber) {
            $episode = new Episode();
            $episode->setTitle($episodeNumber [0]);
            $episode->setNumber($episodeNumber [1]);
            $episode->setSeason($this->getReference("season_1"));

            $manager->persist($episode);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}

