<?php

declare (strict_types=1);
namespace ScoperTest\Bamarni\Composer\Bin\Config;

use ScoperTest\Composer\Config as ComposerConfig;
use ScoperTest\Composer\Factory;
use ScoperTest\Composer\Json\JsonFile;
use ScoperTest\Composer\Json\JsonValidationException;
use ScoperTest\Seld\JsonLint\ParsingException;
final class ConfigFactory
{
    /**
     * @throws JsonValidationException
     * @throws ParsingException
     */
    public static function createConfig(): ComposerConfig
    {
        $config = Factory::createConfig();
        $file = new JsonFile(Factory::getComposerFile());
        if (!$file->exists()) {
            return $config;
        }
        $file->validateSchema(JsonFile::LAX_SCHEMA);
        $config->merge($file->read());
        return $config;
    }
    private function __construct()
    {
    }
}
