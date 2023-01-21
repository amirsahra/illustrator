<?php

namespace Amirsahra\Illustrator\Core\Traits;

use Amirsahra\Illustrator\Exception\NotFoundConfigKeyException;

trait Activated
{
    /**
     * A number of configurations of this package can be activated
     * and deactivated, and with the help of this function, you can
     * check the status of the desired configuration.
     *
     * @param string $configGroup
     * @param string $configKey
     * @return bool
     * @throws NotFoundConfigKeyException
     */
    private function activated(string $configGroup, string $configKey): bool
    {
        $configGroupArray= config('illustrator.' . $configGroup);

        if (!array_key_exists($configKey, $configGroupArray))
            throw new NotFoundConfigKeyException();

        if (is_bool($configGroupArray[$configKey]['is_active']))
            return $configGroupArray[$configKey]['is_active'];

        return false;
    }
}