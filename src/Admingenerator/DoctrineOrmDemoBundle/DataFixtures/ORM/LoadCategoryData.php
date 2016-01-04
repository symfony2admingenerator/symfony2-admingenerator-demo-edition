<?php 

namespace Admingenerator\DoctrineOrmDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Admingenerator\DoctrineOrmDemoBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    private $categoryTree = array(
        'Music' => array('Hip Hop', 'Rock', 'Pop'),
        'Sport' => array('Football', 'Basketball', 'Motorcycle Speedway')
    );

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $hiddenRoot = $this->createCategory('Categories');
        $manager->persist($hiddenRoot);

        foreach ($this->categoryTree as $root => $nodes) {
            $category = $this->createCategory($root);
            $category->setParent($hiddenRoot);

            foreach ($nodes as $node) {
                $subCategory = $this->createCategory($node);
                $subCategory->setParent($category);
                $category->addChild($subCategory);
                $manager->persist($subCategory);
            }

            $manager->persist($category);
        }

        $manager->flush();
    }

    private function createCategory($name)
    {
        $category = new Category();
        $category->setName($name);

        $this->addReference(sprintf('category_%s', strtolower($name)), $category);

        return $category;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
