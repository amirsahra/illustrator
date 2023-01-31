<?php

namespace Amirsahra\Illustrator\Core\Traits;

use Amirsahra\Illustrator\Core\Enums\Disks;
use Amirsahra\Illustrator\Exception\NotFoundConfigKeyException;
use Amirsahra\Illustrator\Exception\NotFoundDiskException;

trait Disk
{
    /**
     * filesystem disk value.
     * @var
     */
    protected $disk;

    /**
     * It takes the name of the disk from the config file and returns it
     * if it is correct.
     *
     * @return mixed
     * @throws NotFoundConfigKeyException
     * @throws NotFoundDiskException
     */
    protected function disk()
    {
        $configImagePathDisk = config('illustrator.disk');
        if (is_null($configImagePathDisk))
            throw new NotFoundConfigKeyException();

        $this->diskExists($configImagePathDisk);
        return $configImagePathDisk;
    }

    /**
     * It sets a value for the disk, if there is no disk with this name,
     * an exception is thrown.
     *
     * @throws NotFoundDiskException
     */
    public function setDisk(string $diskName)
    {
        $this->diskExists($diskName);
        $this->disk = $diskName;
        return $this;
    }

    /**
     * Checks whether the disk with this name exists or not, if there
     * is no disk with this name, an exception is thrown.
     *
     * @throws NotFoundDiskException
     */
    private function diskExists(string $diskName)
    {
        $disks = Disks::list();
        if (!in_array($diskName, $disks))
            throw new NotFoundDiskException();
    }
}