<?php

namespace risingsun\Translation\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use risingsun\Translation\TranslationServiceProvider;

class TestCase extends OrchestraTestCase
{


    protected function getPackageProviders($app)
    {
        return [
            TranslationServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {

        return [
            'TranslationServiceFacade' => 'risingsun\Translation\Facades\TranslationServiceFacade'
        ];
    }
}