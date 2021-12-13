<?php

namespace App\DataFixtures;

use App\Entity\Season;
use App\DataFixtures\ProgramFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public const SEASONS = [

        [1 , 2008 , 'Saison 1'],
        [2 , 2008 , 'Saison 2'],
        [3 , 2008 , 'Saison 3'],
        [4 , 2008 , 'Saison 4'],
        [5 , 2008 , 'Saison 5']

    ];

    public function load(ObjectManager $manager): void
    {
            foreach (self::SEASONS as $key => $seasonName) {
                $season = new Season();
                $season->setNumber($seasonName [0]);
                $season->setYear($seasonName [1]);
                $season->setDescription($seasonName [2]);
                $season->setProgram($this->getReference('program_'));

                $this->addReference('season_' . $key, $season);
                $manager->persist($season);
                }
                $manager->flush();
    }


    public function getDependencies()
    {
        return [
          ProgramFixtures::class,

        ];
    }
}
