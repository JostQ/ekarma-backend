<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TagFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=0; $i < 100; $i++) {
            $tag = new Tag();
            $tag->setName($faker->jobTitle);
            $tag->setTopic($this->getReference('topic_' . rand(0, 99)));
            $manager->persist($tag);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TopicFixtures::class
        ];
    }
}
