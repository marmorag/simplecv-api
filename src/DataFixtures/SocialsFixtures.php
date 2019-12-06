<?php

namespace App\DataFixtures;

use App\Entity\Socials;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SocialsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [ 'icon' => 'mdi-discord', 'url' => 'https://discord.com'],
            [ 'icon' => 'mdi-github-circle', 'url' => 'https://github.com/marmorag' ]
        ];

        foreach ($data as $fixture) {
            $social = new Socials();
            $social->setIcon($fixture['icon']);
            $social->setLink($fixture['url']);

            $manager->persist($social);
        }

        $manager->flush();
    }
}