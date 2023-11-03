<?php


namespace risingsun\Translation\Aliyun;


use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Log;
use risingsun\Translation\TranslationService;
use RuntimeException;

class AliyunTranslationService extends TranslationService
{
    private $accessKeyId;
    private $accessSecret;
    private $regionId;

    private $errorMessage = "";

    public function __construct()
    {
        $this->accessKeyId = config('Translation.channels.aliyun.accessKeyId');
        $this->accessSecret = config('Translation.channels.aliyun.accessSecret');
        $this->regionId = config('Translation.channels.aliyun.regionId');

        if ((empty($this->accessKeyId) || empty($this->accessSecret))) {
            throw new RuntimeException('Unable to boot AliyunTranslationServiceProvider, please set accessKeyId, accessSecret in `config/AliyunTranslation.php` file.');
        }

        try {
            //构建一个阿里云客户端，用于发起请求。
            //构建阿里云客户端时需要设置AccessKey ID和AccessKey Secret。
            AlibabaCloud::accessKeyClient($this->accessKeyId, $this->accessSecret)
                ->regionId($this->regionId)
                ->asDefaultClient();
        } catch (ClientException $e) {
            $this->errorMessage = $e->getErrorMessage();
            Log::error($e->getErrorMessage(), $e->getTrace());
        }
    }

    /**
     * 获取语种信息
     * @param string $sourceText 需要判断语种的内容
     * @return string
     */
    public function getDetectLanguage(string $sourceText): string
    {
        try {
            //设置参数，发起请求。
            $result = AlibabaCloud::rpc()
                ->product('alimt')
                ->scheme('https') // https | http
                ->version('2018-10-12')
                ->action('GetDetectLanguage')
                ->method('POST')
                ->host('mt.' . $this->regionId . '.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => $this->regionId,
                        'SourceText' => $sourceText,
                    ],
                ])
                ->request();
            if ($result->isSuccess() && isset($result->DetectedLanguage)) {
                return $result->DetectedLanguage;
            } else {
                return "";
            }
        } catch (ClientException | ServerException $e) {
            $this->errorMessage = $e->getErrorMessage();
            Log::error($e->getErrorMessage(), $e->getTrace());
            return "";
        }
    }

    /**
     * @param string $originLanguage 源文本的语种
     * @param string $targetLanguage 目标语种
     * @param string $sourceText     要翻译的源内容
     * @return string
     */
    public function translation(string $originLanguage, string $targetLanguage, string $sourceText): string
    {
        if ($originLanguage === $targetLanguage) {
            return $sourceText;
        }
        try {
            //设置参数，发起请求。
            $result = AlibabaCloud::rpc()
                ->product('alimt')
                ->scheme('https') // https | http
                ->version('2018-10-12')
                ->action('TranslateGeneral')
                ->method('POST')
                ->host('mt.' . $this->regionId . '.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => $this->regionId,
                        'FormatType' => "text",
                        'Scene' => "general",
                        'SourceLanguage' => $originLanguage,
                        'SourceText' => $sourceText,
                        'TargetLanguage' => $targetLanguage,
                    ],
                ])
                ->request();
            if ($result->isSuccess() && isset($result->Data) && isset($result->Data->Translated)) {
                return $result->Data->Translated;
            } else {
                return "";
            }
        } catch (ClientException | ServerException $e) {
            $this->errorMessage = $e->getErrorMessage();
            Log::error($e->getErrorMessage(), $e->getTrace());
            return "";
        }
    }

    /**
     * @param string $originLanguage 源文本的语种
     * @param string $targetLanguage 目标语种
     * @param string $sourceText     要翻译的源内容
     * @return string
     */
    public function translationHtml(string $originLanguage, string $targetLanguage, string $sourceText): string
    {
        if ($originLanguage === $targetLanguage) {
            return $sourceText;
        }
        try {
            //设置参数，发起请求。
            $result = AlibabaCloud::rpc()
                ->product('alimt')
                ->scheme('https') // https | http
                ->version('2018-10-12')
                ->action('TranslateGeneral')
                ->method('POST')
                ->host('mt.' . $this->regionId . '.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => $this->regionId,
                        'FormatType' => "html",
                        'Scene' => "general",
                        'SourceLanguage' => $originLanguage,
                        'SourceText' => $sourceText,
                        'TargetLanguage' => $targetLanguage,
                    ],
                ])
                ->request();
            if ($result->isSuccess() && isset($result->Data) && isset($result->Data->Translated)) {
                return $result->Data->Translated;
            } else {
                return "";
            }
        } catch (ClientException | ServerException $e) {
            $this->errorMessage = $e->getErrorMessage();
            Log::error($e->getErrorMessage(), $e->getTrace());
            return "";
        }
    }


    /**
     * @param string $sourceText     要翻译的内容
     * @param string $targetLanguage 要翻译的目标语种
     * @return string 翻译结果
     */
    public function translationAuto(string $sourceText, string $targetLanguage): string
    {
        $originLanguage = $this->getDetectLanguage($sourceText);
        return $this->translation($originLanguage, $targetLanguage, $sourceText);
    }

    /**
     * @return mixed
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

}