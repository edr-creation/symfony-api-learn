<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\BlogPost;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * The Password encoder
     *
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadBlogPosts($manager);
    }

    public function loadBlogPosts(ObjectManager $manager)
    {
        $user = $this->getReference('user_admin');
        
        $blogPost = new BlogPost();
        $blogPost->setTitle('Un premier Post!');
        $blogPost->setPublished(new \DateTime());
        $blogPost->setContent('Contenu du post !');
        $blogPost->setAuthor($user);
        $blogPost->setSlug('un-premier-post');

        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('Un deuxieme Post!');
        $blogPost->setPublished(new \DateTime());
        $blogPost->setContent('Contenu du deuxieme post !');
        $blogPost->setAuthor($user);
        $blogPost->setSlug('un-deuxieme-post');

        $manager->persist($blogPost);

        $manager->flush();
    }

    public function loadComments(ObjectManager $manager)
    {

    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $user->setName('Enzo Do rosario');

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'secret123'
        ));

        $this->addReference('user_admin', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
