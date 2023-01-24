<?php

namespace Amirsahra\Illustrator\Core\Traits;

trait RefactorPath
{
    /**
     * It checks that the directory has the correct format and if there
     * is no / at the end, it adds / to the end to avoid errors.
     *
     * @param string $path
     * @return string
     */
    protected function refactorPath(string $path): string
    {
        $newPath = $path;
        if (str_ends_with($newPath, '/'))
            $newPath =  substr($newPath,0,-1);

        if (str_starts_with($newPath,'/'))
            $newPath =  substr($newPath,1);

        return $newPath;
    }
}