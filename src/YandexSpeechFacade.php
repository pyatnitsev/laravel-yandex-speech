<?php

namespace Jilfond\YandexSpeech;

use Illuminate\Support\Facades\Facade;

class YandexSpeechFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return YandexSpeech::class;
    }
}