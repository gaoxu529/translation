<?php

namespace risingsun\Translation\Tests;

use Illuminate\Support\Facades\Config;
use risingsun\Translation\TranslationService;

class AliyunTranslationServiceTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $translationDriver = env('TRANSLATION_DRIVER', 'aliyun');
        $accessKeyId = env('ALIYUN_TRANSLATION_ACCESS_KEY_ID', 'LTAI5tAXE78JD6aLLzDDdfpT');
        $accessSecret = env('ALIYUN_TRANSLATION_ACCESS_KEY_SECRET', 'OMWRc8BLIJRZV6lRcKd4OgKKJBhKDY');
        $regionId = env('ALIYUN_TRANSLATION_REGION_ID', 'cn-hongkong');

        Config::set("Translation.default", $translationDriver);
        Config::set('Translation.channels.aliyun.accessKeyId', $accessKeyId);
        Config::set('Translation.channels.aliyun.accessSecret', $accessSecret);
        Config::set('Translation.channels.aliyun.regionId', $regionId);
    }

    public function testServiceCanBeResolvedFromContainer()
    {
        exec('php -v');
        if (!empty($this)) {
            $service = $this->app->make(TranslationService::class);
        }
        $this->assertInstanceOf(TranslationService::class, $service);
    }

    public function testAliyunTranslationService()
    {
        Config::set("Translation.default", 'aliyun');
        if (!empty($this)) {
            $service = $this->app->make(TranslationService::class);
        }
        $result = $service->translation('en', 'zh', 'hello world');
        $this->assertEquals('你好世界', $result);
    }

//    public function testGoogleTranslationService()
//    {
//        Config::set("Translation.default", 'google');
//        $service = $this->app->make(TranslationService::class);
//        $result = $service->translation('hello world', 'en', 'zh');
//        $this->assertEquals('你好，世界', $result);
//    }
}