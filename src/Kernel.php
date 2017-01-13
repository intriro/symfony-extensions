<?php

declare(strict_types=1);

namespace Intriro\Symfony;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

abstract class Kernel extends BaseKernel
{
    /**
     * @var string
     */
    private $vagrantTmpDir = '/dev/shm';

    /**
     * {@inheritdoc}
     */
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
            'kernel.resource_dir' => $this->getResourceDir(),
        ];

        return array_merge($extraParameters, parent::getKernelParameters());
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if ($this->isVagrantEnvironment()) {
            return $this->vagrantTmpDir.'/sf/cache/'.$this->environment;
        }

        return $this->getVarDir().'/cache/'.$this->environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if ($this->isVagrantEnvironment()) {
            return $this->vagrantTmpDir.'/sf/logs';
        }

        return $this->getVarDir().'/logs';
    }

    /**
     * @return string
     */
    public function getResourceDir()
    {
        return $this->rootDir.'/../resources';
    }

    /**
     * @return bool
     */
    protected function isVagrantEnvironment()
    {
        return ((bool) getenv('VAGRANT')) === true && is_dir($this->vagrantTmpDir);
    }

    /**
     * @return Kernel
     */
    public static function fromEnvironment()
    {
        if (EnvHelper::isDevelopmentEnvironment()) {
            Debug::enable();
        }

        return new static(
            EnvHelper::getEnv(),
            EnvHelper::isDebugEnabled()
        );
    }
}
