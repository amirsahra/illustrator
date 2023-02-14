<?php

namespace Amirsahra\Illustrator\Core\Traits;

use Amirsahra\Illustrator\Exception\NotFoundConfigKeyException;
use Exception;
use Illuminate\Support\Str;

trait NameCreator
{
    use Activated;

    /**
     * Array of values related to the image in the config file.
     */
    private $configImagePath;

    /**
     * Image name value.
     * @var
     */
    protected $name;

    public function __construct()
    {
        $this->configImagePath = config('illustrator.image_path');
    }

    /**
     * It creates a random name with the filtered values in the config
     * related to the image.
     * If all config values are disabled, then only one string will be
     * generated randomly.
     *
     * @return string
     * @throws NotFoundConfigKeyException
     * @throws Exception
     */
    protected function createName(): string
    {
        $name = $this->createPrefix() .
            $this->createRandomString() .
            $this->createPostfix();

        return $name ?: Str::random();
    }

    /**
     * Sets a value for the image name.
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $this->refactorPath($name);
        return $this;
    }

    /**
     * Creating a random string with a specific length that can be
     * determined from the config file.
     *
     * @return string
     * @throws NotFoundConfigKeyException
     */
    private function createRandomString()
    {
        $randomString = Str::random();
        if ($this->activated('image_path', 'random_string')) {
            $length = $this->configImagePath['random_string']['length'];
            $randomString = Str::random($length);
        }
        return $randomString;
    }

    /**
     * Creating a prefix string with a specific value that can be
     * determined from the config file.
     *
     * @return string
     * @throws NotFoundConfigKeyException
     */
    private function createPrefix()
    {
        $prefix = '';
        if ($this->activated('image_path', 'prefix')) {
            $prefix = $this->configImagePath['prefix']['value'];
        }
        return (string)$prefix;
    }

    /**
     * Creating a postfix string with a specific value that can be
     * determined from the config file.
     *
     * @return string
     * @throws NotFoundConfigKeyException
     */
    private function createPostfix()
    {
        $postfix = '';
        if ($this->activated('image_path', 'postfix')) {
            $postfix = $this->configImagePath['postfix']['value'];
        }
        return (string)$postfix;
    }

}