<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * @var string
     */
    private $tempDir = null;

    public function __construct($environment, $debug)
    {
        parent::__construct($environment, $debug);

        $envParameters = $this->getEnvParameters();
        if (array_key_exists('vagrant.env', $envParameters)) {
            $this->tempDir = sys_get_temp_dir() . '/' . $envParameters['vagrant.env'];
        }
    }

    public function getCacheDir()
    {
        if (!is_null($this->tempDir)) {
            return $this->tempDir . '/cache/' . $this->getEnvironment();
        }

        return parent::getCacheDir();
    }

    public function getLogDir()
    {
        if (!is_null($this->tempDir)) {
            return $this->tempDir . '/logs';
        }

        return parent::getLogDir();
    }

    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            // S2A GeneratorBundle deps
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new Liuggio\ExcelBundle\LiuggioExcelBundle(),
            new Admingenerator\GeneratorBundle\AdmingeneratorGeneratorBundle(),
            // S2A Demo deps
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Admingenerator\DashboardDemoBundle\AdmingeneratorDashboardDemoBundle(),
            new Admingenerator\DoctrineOrmDemoBundle\AdmingeneratorDoctrineOrmDemoBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    /**
     * Gets the environment parameters.
     *
     * Only the parameters starting with "SYMFONY__" are considered.
     *
     * @return array An array of parameters
     */
    protected function getEnvParameters()
    {
        $parameters = array();

        foreach ($_SERVER as $key => $value) {
            if (0 === strpos($key, 'SYMFONY__')) {
                $parameters[strtolower(str_replace('__', '.', substr($key, 9)))] = $value === '~'?null:$value;
            }
        }

        return $parameters;
    }
}
