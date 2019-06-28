<?php

namespace App\DataFixtures;

use App\Entity\Badge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class BadgeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=0; $i < 10; $i++) {
            $badge = new Badge();
            $badge->setLevelMin($i);
            $badge->setName($faker->citySuffix);
            $badge->setImgUrl('https://placekitten.com/g/150/150');
            $badge->setDescription($faker->text);
            $manager->persist($badge);

            $this->addReference('badge_' . $i, $badge);
        }
        $manager->flush();
    }
}
