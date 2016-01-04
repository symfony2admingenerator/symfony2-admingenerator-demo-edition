<?php 

namespace Admingenerator\DoctrineOrmDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admingenerator\DoctrineOrmDemoBundle\Entity\Post;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $postA = $this->createPost(
            'Brasil 2014!',
            '<b>I can\'t wait for Football World Championship in Brasil!<b><br />
             <p>I really hope Ronaldo will lead Portugal into the finals. I\'m so 
             excited to see his goals!</p>',
            '2014-02-19',
            true,
            'Football',
            array('Amazing', 'Can\'t wait')
        );

        $postB = $this->createPost(
            'George Michael\'s new album released!',
            '<p>Finally the long awaited "Symphonica" album is released!
             I\'ll be buying my copy first thing in the morning!</p>',
            '2014-03-12',
            true,
            'Pop',
            array('Amazing', 'Finally')
        );

        $postC = $this->createPost(
            'Eminem music is bad for your health',
            '<p>I was listening to Eninem while jogging this morning and then I got hit by a car.
             I love Eminem music, but it\'s bad for my health.</p>',
            '2014-05-12',
            false,
            'Hip Hop',
            array('Funny', 'Silly')
        );

        $manager->persist($postA);
        $manager->persist($postB);
        $manager->persist($postC);
        $manager->flush();
    }

    private function createPost($title, $content, $date, $published, $categoryName, $tagNames)
    {
        $post = new Post();
        $post->setTitle($title);
        $post->setCreatedAt(new \DateTime($date));
        $post->setAuthor('John Doe');
        $post->setContent($content);
        $post->setIsPublished($published);
        $post->setCategory($this->getReference(sprintf('category_%s', strtolower($categoryName))));

        foreach($tagNames as $tagName) {
            $post->addTag($this->getReference(sprintf('tag_%s', strtolower($tagName))));
        }

        return $post;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }
}
