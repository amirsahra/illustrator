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
        $this->dir = $this->refactorDir($directory);
        return $this;
    }

    /**
     * It checks that the directory has the correct format and if there
     * is no / at the end, it adds / to the end to avoid errors.
     *
     * @param string $directory
     * @return string
     */
    protected function refactorDir(string $directory): string
    {
        if (str_ends_with($directory, '/'))
            return substr($directory,0,-1);
        return $directory;
    }

}
