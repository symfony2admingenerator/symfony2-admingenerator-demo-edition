<?php

namespace Admingenerator\DashboardDemoBundle\Menu;

use Admingenerator\GeneratorBundle\Menu\AdmingeneratorMenuBuilder;
use JMS\SecurityExtraBundle\Security\Authorization\Expression\Expression;
use Knp\Menu\FactoryInterface;

class DashboardMenuBuilder extends AdmingeneratorMenuBuilder
{
    protected $translation_domain = 'AdmingeneratorDashboardDemoMenu';
    
    /**
     * Check security expression
     * @param string $expression
     * @return bool 
     */
    private function isGranted($expression)
    {
        return $this->container->get('security.context')->isGranted(array(
            new Expression($expression)
        ));
    }
    
    public function navbarMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('id' => 'main_navigation', 'class' => 'nav navbar-nav'));
        
        $this->addWelcomeMenu($menu);
        $this->addSecuredMenu($menu);
        
        return $menu;
    }
    
    private function addWelcomeMenu($menu)
    {
        $welcome = $this->addDropdown($menu, 'welcome.dropdown');
        
        $this->addLinkRoute($welcome, 'welcome.welcome', 'admingenerator_demo_welcome');
        
        $this->addDivider($welcome);
        
        $this->addHeader($welcome, 'headers.doctrine_orm');
        
        $this->addLinkRoute($welcome, 'welcome.post', 'Admingenerator_DoctrineOrmDemoBundle_Post_list');
        $this->addLinkRoute($welcome, 'welcome.category', 'Admingenerator_DoctrineOrmDemoBundle_Category_list');
        $this->addLinkRoute($welcome, 'welcome.tag', 'Admingenerator_DoctrineOrmDemoBundle_Tag_list');
        
        return $menu;
    }
    
    private function addSecuredMenu($menu)
    {
        if ($this->isGranted('canSeeSecuredMenu()')) {
            $secured = $this->addDropdown($menu, 'secured.dropdown');
        }
        
        return $menu;
    }
}