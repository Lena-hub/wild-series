<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $program = new Program();
        $program->setTitle('Atypical');
        $program->setSummary("Sam Gardner, un garçon de 18 ans vivant dans le Connecticut et ayant un trouble du spectre de l'autisme (TSA), annonce à sa famille qu'il veut avoir une petite amie.");
        $program->setPoster('https://fr.web.img3.acsta.net/pictures/19/10/21/14/58/4891368.jpg');
        $program->setCountry('Quebec');
        $program->setYear('2017');
        $program->setCategory($this->getReference('category_6'));
        $this->addReference('program_' , $program);
        //ici les acteurs sont insérés via une boucle pour être DRY mais ce n'est pas obligatoire
        for ($i=0; $i < count(ActorFixtures::ACTORS); $i++) {
            $program->addActor($this->getReference('actor_' . $i));
        }
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ActorFixtures::class,
          CategoryFixtures::class,
        ];
    }
}

