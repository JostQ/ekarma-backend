<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for($i=0; $i < 20; $i++){
            $user = new User();
            $user->setNickname($faker->word);
            $user->setEmail($faker->unique()->email);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'alexleBG'
            ));
            $user->setRoles(['ROLE_USER']);
            $user->setCreatedAt($faker->unixTime());
            $user->setImgUrl('avatar' . rand(1, 7));
            $user->setKarma(rand(-100, 100));

            $karma = $user->getKarma();
            $j = 0;
            while ($karma > 0) {
                if ($karma >= 10) {
                    $karma -= 10;
                    $user->addBadge($this->getReference('badge_' . $j));
                    $j++;
                } else {
                    break;
                }
            }
            $manager->persist($user);

            $this->addReference('user_' . $i, $user);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BadgeFixtures::class
        ];
    }
}
