<?php

namespace risingsun\Translation\Tests;

use risingsun\Translation\TranslationService;

class AliyunTranslationServiceTest extends TestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $translationDriver = env('TRANSLATION_DRIVER', 'aliyun');
        $accessKeyId = env('ALIYUN_TRANSLATION_ACCESS_KEY_ID', '');
        $accessSecret = env('ALIYUN_TRANSLATION_ACCESS_KEY_SECRET', '');
        $regionId = env('ALIYUN_TRANSLATION_REGION_ID', 'cn-hongkong');

        $app['config']->set('Translation.default', $translationDriver);
        $app['config']->set('Translation.channels.aliyun.accessKeyId', $accessKeyId);
        $app['config']->set('Translation.channels.aliyun.accessSecret', $accessSecret);
        $app['config']->set('Translation.channels.aliyun.regionId', $regionId);
    }

    public function testServiceCanBeResolvedFromContainer()
    {
        if (!empty($this)) {
            $service = $this->app->make(TranslationService::class);
        }
        $this->assertInstanceOf(TranslationService::class, $service);
    }
}