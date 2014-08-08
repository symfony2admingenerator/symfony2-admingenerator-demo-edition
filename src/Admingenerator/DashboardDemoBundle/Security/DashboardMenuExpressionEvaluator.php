<?php

namespace Admingenerator\DashboardDemoBundle\Security;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @DI\Service 
 */
class DashboardMenuExpressionEvaluator
{
    protected $container;

    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container"),
     * })
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @DI\SecurityFunction("canSeeSecuredMenu")
     */
    public function canSeeSecuredMenu()
    {
        return $this->container->get('security.context')->isGranted('ROLE_USER');
    }
}
