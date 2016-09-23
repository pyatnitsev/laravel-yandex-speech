## What is it?

This is small library, that adds Facade in laravel 5, that implements Yandex Speech Kit Cloud.

At this moment, library can transform audio file to text only.

## Installation

**Composer**

Run the following to include this via Composer

```shell 
   composer require pyatnitsev/yandex-speech
```

**Laravel 5 Configuration**
 
To install into a Laravel project, first do the composer install then add class to your config/app.php service providers list.

```php 
   Pyatnitsev\YandexSpeech\YandexSpeechServiceProvider::class,
```


## Usage

Add using for facade: 

```php 
   use Pyatnitsev\YandexSpeech\YandexSpeechFacade;
```

and next use it in controller:

```php 
   YandexSpeechFacade::getTextByAudioByURL($filePath);
```

this method returns best suggestion or false if no suggestions



### License

This package is licensed under the [MIT license](https://github.com/backup-manager/laravel/blob/master/LICENSE).