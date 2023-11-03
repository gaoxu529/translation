<?php


namespace risingsun\Translation\Google;


use risingsun\Translation\TranslationService;


class GoogleTranslationService extends TranslationService
{

    private $errorMessage = "";

    public function __construct()
    {

    }

    /**
     * 获取语种信息
     * @param string $sourceText 需要判断语种的内容
     * @return string
     */
    public function getDetectLanguage(string $sourceText): string
    {
        return "this is the google translation service getDetectLanguage.";
    }

    /**
     * @param string $originLanguage 源文本的语种
     * @param string $targetLanguage 目标语种
     * @param string $sourceText     要翻译的源内容
     * @return string
     */
    public function translation(string $originLanguage, string $targetLanguage, string $sourceText): string
    {
        return "this is the google translation service translation.";
    }

    /**
     * @param string $sourceText     要翻译的内容
     * @param string $targetLanguage 要翻译的目标语种
     * @return string 翻译结果
     */
    public function translationAuto(string $sourceText, string $targetLanguage): string
    {
        return "this is the google translation service translationAuto.";
    }

    /**
     * @return mixed
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

}