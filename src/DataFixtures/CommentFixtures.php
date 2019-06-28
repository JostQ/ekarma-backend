<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for ($j=0; $j < 100; $j++) {
            for($i=0; $i < 50; $i++) {
                $comment = new Comment();
                $comment->setTimestamp($faker->unique()->unixTime());
                $comment->setGood(rand(0, 200));
                $comment->setBad(rand(0, 300));
                $comment->setAuthor($this->getReference('user_' . rand(0, 19)));
                $comment->setTopic($this->getReference('topic_' . $j));
                $manager->persist($comment);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TopicFixtures::class,
            UserFixtures::class
        ];
    }
}
