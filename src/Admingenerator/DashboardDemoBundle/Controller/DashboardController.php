<?php

namespace Admingenerator\DashboardDemoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="admingenerator_demo_welcome")
     * @Template("AdmingeneratorDashboardDemoBundle::welcome.html.twig")
     */
    public function welcomeAction()
    {
        return array();
    }
}
