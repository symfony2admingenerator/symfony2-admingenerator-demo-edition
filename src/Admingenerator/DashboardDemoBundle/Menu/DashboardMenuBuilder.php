<?php

namespace Admingenerator\DashboardDemoBundle\Menu;

use Admingenerator\GeneratorBundle\Menu\AdmingeneratorMenuBuilder;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DashboardMenuBuilder extends AdmingeneratorMenuBuilder
{
    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    public function __construct(FactoryInterface $factory, AuthorizationCheckerInterface $authorizationChecker, RequestStack $requestStack)
    {
        parent::__construct($factory, $requestStack, 'admingenerator_demo_welcome');

        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * Check security expression
     * @param string $expression
     * @return bool 
     */
    private function isGranted($expression)
    {
        return $this->authorizationChecker->isGranted($expression);
    }
    
    public function navbarMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'sidebar-menu'));

        if ($dashboardRoute = $this->dashboardRoute) {
            $this
                ->addLinkRoute($menu, 'admingenerator.dashboard', $dashboardRoute)
                ->setExtra('icon', 'fa fa-dashboard');
        }
        $this->translation_domain = 'AdmingeneratorDashboardDemoMenu';

        $this->addWelcomeMenu($menu);
        $this->addSecuredMenu($menu);
        
        return $menu;
    }
    
    private function addWelcomeMenu($menu)
    {
        $welcome = $this->addDropdown($menu, 'welcome.dropdown');
        
        $this->addLinkRoute($welcome, 'welcome.welcome', 'admingenerator_demo_welcome');
        $this->addLinkRoute($welcome, 'welcome.post', 'Admingenerator_DoctrineOrmDemoBundle_Post_list');
        $this->addLinkRoute($welcome, 'welcome.category', 'Admingenerator_DoctrineOrmDemoBundle_Category_list');
        $this->addLinkRoute($welcome, 'welcome.tag', 'Admingenerator_DoctrineOrmDemoBundle_Tag_list');
        
        return $menu;
    }
    
    private function addSecuredMenu($menu)
    {
        if ($this->isGranted('ROLE_USER')) {
            $this->addDropdown($menu, 'secured.dropdown');
        }
        
        return $menu;
    }
}