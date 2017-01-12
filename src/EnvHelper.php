<?php

declare(strict_types=1);

namespace Intriro\Symfony;

class EnvHelper
{
    /**
     * @return string
     */
    public static function getEnv(): string
    {
        return getenv('SYMFONY_ENV') ?: 'prod';
    }

    /**
     * @return bool
     */
    public static function isProductionEnvironment(): bool
    {
        return self::getEnv() === 'prod';
    }

    /**
     * @return bool
     */
    public static function isDevelopmentEnvironment(): bool
    {
        return !self::isProductionEnvironment();
    }

    /**
     * @return bool
     */
    public static function isDebugEnabled(): bool
    {
        return (bool) getenv('SYMFONY_DEBUG');
    }
}
