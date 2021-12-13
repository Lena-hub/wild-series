<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public const ACTORS = [
        'Alice Braye',
        'Benjamin Affile',
        'Damien Chantreau',
        'Emiliano Ostellino ',
        'Gwilherm Couffy',
        'Jessie Durand',
        'Johan Mabit',
        'Karl Morisset',
        'Lena Le Billan',
        'Nathalie Charles',
        'Yann Malfer',
        'Lee Jung-Jae',
        'Park Hae-Soo',
        'Wi Ha-joon',
        'Jung Ho-Yeon'
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::ACTORS as $key => $actorName) {
            $actor = new Actor();
            $actor->setName($actorName);
            $manager->persist($actor);
            $this->addReference('actor_' . $key, $actor);
        }
        $manager->flush();
    }
}

