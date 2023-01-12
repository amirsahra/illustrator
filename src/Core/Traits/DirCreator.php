<?php

namespace Amirsahra\Illustrator\Core\Traits;

use Amirsahra\Illustrator\Exception\NotFoundConfigKeyException;

trait DirCreator
{
    /**
     * Image directory value.
     * @var
     */
    protected $dir;

    /**
     * The directory where the image files are stored.
     * Its default value can be edited in the `illustrator.image_path.dir`
     * config file.If the default value is selected and does not exist in
     * the config file, an exception will be sent.
     *
     * @return string
     * @throws NotFoundConfigKeyException
     */
    protected function createDir()
    {
        $configImagePathDir = config('illustrator.image_path.dir');
        if (is_null($configImagePathDir))
            throw new NotFoundConfigKeyException();

        return $configImagePathDir;
    }

    /**
     * When we want to choose the image directory arbitrarily and do not
     * choose the default value set in the configuration, we use this
     * function along with the name of the desired directory.
     *
     * @param string $directory
     * @return $this
     */
    public function setDir(string $directory)
    {
        $this->dir = $directory;
        return $this;
    }

}
