<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\BlogPost;

class AppFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $blogPost = new BlogPost();
        $blogPost->setTitle('Un premier Post!');
        $blogPost->setPublished(new \DateTime());
        $blogPost->setContent('Contenu du post !');
        $blogPost->setAuthor('Enzo Do rosario');
        $blogPost->setSlug('un-premier-post');

        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('Un deuxieme Post!');
        $blogPost->setPublished(new \DateTime());
        $blogPost->setContent('Contenu du deuxieme post !');
        $blogPost->setAuthor('Enzo De rosario');
        $blogPost->setSlug('un-deuxieme-post');

        $manager->persist($blogPost);

        $manager->flush();
    }
}
