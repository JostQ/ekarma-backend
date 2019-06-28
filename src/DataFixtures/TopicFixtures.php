<?php

namespace App\DataFixtures;

use App\Entity\Topic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TopicFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=0; $i < 100; $i++) {
            $topic = new Topic();
            $topic->setTitle($faker->sentence);
            $topic->setContent($faker->paragraph);
            $topic->setTimestamp($faker->unixTime());
            $topic->setAuthor($this->getReference('user_' . rand(0, 19)));
            $manager->persist($topic);

            $this->addReference('topic_' . $i, $topic);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
