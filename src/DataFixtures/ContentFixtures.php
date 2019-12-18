<?php
declare(strict_types=1);

namespace App\DataFixtures;


use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ContentFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager): void
    {
        $content = new Content();
        $content->setContent('<div>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad adipisci
                                    aspernatur, assumenda consequuntur cupiditate delectus dolorem eaque, eum explicabo
                                    inventore ipsum neque obcaecati officia perferendis ratione tempore veritatis
                                    voluptate.
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad adipisci
                                    aspernatur, assumenda consequuntur cupiditate delectus dolorem eaque, eum explicabo
                                    inventore ipsum neque obcaecati officia perferendis ratione tempore veritatis
                                    voluptate.
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad adipisci
                                    aspernatur, assumenda consequuntur cupiditate delectus dolorem eaque, eum explicabo
                                    inventore ipsum neque obcaecati officia perferendis ratione tempore veritatis
                                    voluptate.
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad adipisci
                                    aspernatur, assumenda consequuntur cupiditate delectus dolorem eaque, eum explicabo
                                    inventore ipsum neque obcaecati officia perferendis ratione tempore veritatis
                                    voluptate.
                                </div>
                                <div>Adipisci aliquam delectus fugit, ipsum maiores molestias necessitatibus nisi nobis,
                                    reiciendis ut vel, veniam. Adipisci delectus deleniti dolorem eos harum labore neque
                                    quae quaerat, qui rerum, soluta vitae! Illum, laborum.
                                </div>
                                <div>A architecto, aut dolorem, dolores ex expedita facilis fugit hic id iure magnam
                                    neque nobis numquam pariatur porro possimus qui quos ratione recusandae repellendus
                                    suscipit temporibus ut veritatis voluptate voluptates.
                                </div>
                                <div>A aliquam aspernatur at atque blanditiis dicta error est ex excepturi hic neque
                                    nihil nobis omnis praesentium quo recusandae rem repudiandae sint soluta suscipit,
                                    ullam vel vitae voluptate voluptates voluptatibus.
                                </div>
                                <div>Architecto cum doloremque et nihil quam vel vero. Aliquid aspernatur culpa facere
                                    impedit maxime nihil, non odit, provident quasi velit, veritatis vitae. Accusamus
                                    dolore eius iusto necessitatibus perspiciatis praesentium tenetur.
                                </div>');

        $manager->persist($content);
        $manager->flush();
    }
}