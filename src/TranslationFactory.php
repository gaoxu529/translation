<?php


namespace risingsun\Translation;

use risingsun\Translation\Aliyun\AliyunTranslationService;
use risingsun\Translation\Google\GoogleTranslationService;
use RuntimeException;

class TranslationFactory
{
    public static function create(string $name): ?ITranslationService
    {
        switch ($name) {
            case "aliyun":
                return new AliyunTranslationService();
            case "google":
                return new GoogleTranslationService();
        }
        throw new RuntimeException("The Service '$name' not exists.");
    }
}