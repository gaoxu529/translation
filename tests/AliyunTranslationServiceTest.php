<?php

namespace risingsun\Translation\Tests;

use Illuminate\Support\Facades\Config;
use risingsun\Translation\TranslationService;

class AliyunTranslationServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->getEnvironmentSetUp($this->app);
    }

    protected function getEnvironmentSetUp($app)
    {
        echo "AliyunTranslationServiceTest getEnvironmentSetUp\n";
        $translationDriver = env('TRANSLATION_DRIVER', 'aliyun');
        $accessKeyId = env('ALIYUN_TRANSLATION_ACCESS_KEY_ID', '');
        $accessSecret = env('ALIYUN_TRANSLATION_ACCESS_KEY_SECRET', '');
        $regionId = env('ALIYUN_TRANSLATION_REGION_ID', 'cn-hongkong');

        echo "translationDriver: $translationDriver\n";
        echo "accessKeyId: $accessKeyId\n";
        echo "accessSecret: $accessSecret\n";
        echo "regionId: $regionId\n";

        Config::set("Translation.default",$translationDriver);
        Config::set('Translation.channels.aliyun.accessKeyId', $accessKeyId);
        Config::set('Translation.channels.aliyun.accessSecret', $accessSecret);
        Config::set('Translation.channels.aliyun.regionId', $regionId);
    }

    public function testServiceCanBeResolvedFromContainer()
    {
        $this->getEnvironmentSetUp($this->app);
        echo "AliyunTranslationServiceTest testServiceCanBeResolvedFromContainer\n";
        if (!empty($this)) {
            $service = $this->app->make(TranslationService::class);
        }
        $this->assertInstanceOf(TranslationService::class, $service);
    }
}