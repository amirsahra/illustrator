<?php

namespace Amirsahra\Illustrator;

use Amirsahra\Illustrator\Core\Traits\DirCreator;
use Amirsahra\Illustrator\Core\Traits\Disk;
use Amirsahra\Illustrator\Core\Traits\NameCreator;
use Amirsahra\Illustrator\Core\Traits\RefactorPath;
use Amirsahra\Illustrator\Exception\InvalidNameException;
use Amirsahra\Illustrator\Exception\NotFoundConfigKeyException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Illustrator
{
    use DirCreator, Disk, NameCreator {
        NameCreator::__construct as nameConstruct;
    }

    /**
     * Getting the default value from settings and setting variables.
     * The variable's dir,name,disk are defined as public in their
     * traits so that they can be accessed in this class.
     *
     * @throws NotFoundConfigKeyException
     * @throws Exception\NotFoundDiskException
     */
    public function __construct()
    {
        $this->nameConstruct();
        $this->dir = $this->createDir();
        $this->name = $this->createName();
        $this->disk = $this->disk();
    }

    /**
     *
     *
     * @param UploadedFile $imageInputRequest
     * @return string
     * @throws InvalidNameException
     */
    public function upload(UploadedFile $imageInputRequest): string
    {
        $imageType = $imageInputRequest->extension();
        $imageName = $this->name . '.' . $imageType;
        $imagePath = $this->dir . $imageName;
        if ($this->imageExists($imagePath, $this->disk))
            throw new InvalidNameException();

        return Storage::disk($this->disk)
            ->putFileAs($this->dir, $imageInputRequest, $imageName);
    }

    /**
     * @throws InvalidNameException
     */
    public function update(UploadedFile $imageInputRequest, string $imagePath): string
    {
        if ($this->imageExists($imagePath, $this->disk)) {
            Storage::disk($this->disk)->delete($imagePath);
        }
        return $this->upload($imageInputRequest);
    }

    private function imageExists(string $imagePath, string $disk): bool
    {
        return Storage::disk($disk)->exists($imagePath);
    }

}