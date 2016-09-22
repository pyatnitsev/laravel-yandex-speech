<?php

namespace Jilfond\YandexSpeech;

use Illuminate\Support\ServiceProvider;

class YandexSpeechServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'../../config/yandex-speech.php', 'yandex-speech');
        $this->publishes([
            __DIR__.'../../config/yandex-speech.php' => config_path('yandex-speech.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('YandexSpeech', YandexSpeechFacade::class);
    }
}
