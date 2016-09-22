<?php

namespace Pyatnitsev\YandexSpeech;

use Illuminate\Support\Facades\Facade;

class YandexSpeechFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return YandexSpeech::class;
    }
}