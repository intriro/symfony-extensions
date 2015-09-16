<?php
namespace Intriro\Symfony;

use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Config\Loader\LoaderInterface;

abstract class Kernel extends BaseKernel
{
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getResourceDir().'/config/config_'.$this->getEnvironment().'.yml');
        $loader->load($this->getResourceDir().'/config/application.yml');
        $loader->load($this->getResourceDir().'/config/parameters.yml');
    }

    /**
     * Gets the var directory.
     *
     * @return string The var directory
     */
    public function getVarDir()
    {
        return $this->rootDir.'/../var';
    }

    /**
     * {@inheritdoc}
     */
    protected function getKernelParameters()
    {
        $extraParameters = [
            'kernel.var_dir' => $this->getVarDir(),
            'kernel.resource_dir' => $this->getResourceDir()
        ];

        return array_merge($extraParameters, parent::getKernelParameters());
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if (in_array($this->environment, ['dev', 'test']) && getenv('VAGRANT')) {
            return '/dev/shm/sf/cache/' .  $this->environment;
        }

        return parent::getCacheDir();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if (in_array($this->environment, ['dev', 'test']) && getenv('VAGRANT')) {
            return '/dev/shm/sf/logs';
        }

        return parent::getLogDir();
    }

    public function getResourceDir()
    {
        return $this->rootDir.'/../resources';
    }
}
