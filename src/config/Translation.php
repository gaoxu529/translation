<?php
/**
 * Created by PhpStorm.
 * User: GaoXu
 * Date: 2021-08-23
 * Time: 15:46
 */
return [
    'default' => env('TRANSLATION_DRIVER', 'aliyun'),

    'channels' => [

        'aliyun' => [
            'accessKeyId' => env("ALIYUN_TRANSLATION_ACCESS_KEY_ID", ""),
            'accessSecret' => env("ALIYUN_TRANSLATION_ACCESS_KEY_SECRET", ""),
            'regionId' => env("ALIYUN_TRANSLATION_REGION_ID", "cn-hangzhou"),
        ],

        'google' => [

        ],

        'baidu' => [

        ]
    ]
];