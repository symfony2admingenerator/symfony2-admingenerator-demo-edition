<?php

namespace Admingenerator\DashboardDemoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    /**
     * @Route("/", name="admingenerator_demo_welcome")
     */
    public function welcomeAction()
    {
        return $this->render('AdmingeneratorDashboardDemoBundle::welcome.html.twig');
    }
}
