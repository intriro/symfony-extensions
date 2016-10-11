<?php
namespace Intriro\Symfony;


class EnvHelper
{
    /**
     * @return string
     */
    public static function getEnv()
    {
        return getenv('SYMFONY_ENV') ?: 'prod';
    }

    /**
     * @return string
     */
    public static function isProductionEnvironment()
    {
        return self::getEnv() == 'prod';
    }

    /**
     * @return string
     */
    public static function isDevelopmentEnvironment()
    {
        return !self::isProductionEnvironment();
    }

    /**
     * @return bool
     */
    public static function isDebugEnabled()
    {
        return (bool) getenv('SYMFONY_DEBUG');
    }
}
