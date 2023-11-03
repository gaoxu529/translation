<?php

namespace risingsun\Translation;

interface ITranslationService
{
    function getDetectLanguage(string $sourceText): string;

    function translation(string $originLanguage, string $targetLanguage, string $sourceText): string;

    function translationAuto(string $sourceText, string $targetLanguage): string;

    function translationHtml(string $originLanguage, string $targetLanguage, string $sourceText): string;
}