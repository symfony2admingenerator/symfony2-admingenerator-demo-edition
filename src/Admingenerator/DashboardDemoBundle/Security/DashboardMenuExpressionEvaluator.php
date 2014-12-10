<?php

namespace Admingenerator\DashboardDemoBundle\Security;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * @DI\Service 
 */
class DashboardMenuExpressionEvaluator
{
    /**
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * @DI\InjectParams({
     *     "securityContext" = @DI\Inject("security.context"),
     * })
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * @DI\SecurityFunction("canSeeSecuredMenu")
     */
    public function canSeeSecuredMenu()
    {
        return $this->securityContext->isGranted('ROLE_USER');
    }
}
