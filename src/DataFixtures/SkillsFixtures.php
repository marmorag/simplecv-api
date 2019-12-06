<?php

namespace App\DataFixtures;

use App\Entity\Skills;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SkillsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [ 'name' => 'Terraform', 'level' => 30],
            [ 'name' => 'Go', 'level' => 30],
            [ 'name' => 'Symfony', 'level' => 70],
            [ 'name' => 'VueJs', 'level' => 70],
        ];

        foreach ($data as $fixture) {
            $skills = new Skills();
            $skills->setName($fixture['name']);
            $skills->setLevel($fixture['level']);

            $manager->persist($skills);
        }

        $manager->flush();
    }
}