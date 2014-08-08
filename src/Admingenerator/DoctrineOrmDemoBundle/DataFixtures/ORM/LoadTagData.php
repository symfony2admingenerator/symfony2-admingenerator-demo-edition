<?php 

namespace Admingenerator\DoctrineOrmDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admingenerator\DoctrineOrmDemoBundle\Entity\Tag;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    private $tags = array('Amazing', 'Funny', 'Sad', 'Silly', 'Can\'t wait', 'Finally');

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->tags as $name) {
            $tag = $this->createTag($name);
            $manager->persist($tag);
        }

        $manager->flush();
    }

    private function createTag($name)
    {
        $tag = new Tag();
        $tag->setName($name);

        return $tag;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
