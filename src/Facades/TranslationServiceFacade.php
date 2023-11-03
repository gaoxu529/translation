<?php

namespace risingsun\Translation\Facades;

use Illuminate\Support\Facades\Facade;

class TranslationServiceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "TranslationService";
    }
}