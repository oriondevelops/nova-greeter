<?php

namespace Orion\NovaGreeter;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CardServiceProvider extends ServiceProvider
{
    public static string $name = 'nova-greeter';

    public function boot(): void
    {
        $this->publishes([__DIR__.'/../resources/lang' => lang_path('vendor/nova/'.static::$name)]);

        Nova::serving(function (ServingNova $event) {
            Nova::script(static::$name, __DIR__.'/../dist/js/card.js');
            Nova::style(static::$name, __DIR__.'/../dist/css/card.css');
            Nova::translations(static::getTranslations());
        });
    }

    private static function getTranslations(): array
    {
        $translationFile = lang_path('vendor/nova/'.static::$name.'/'.app()->getLocale().'.json');

        if (! is_readable($translationFile)) {
            $translationFile = __DIR__.'/../resources/lang/'.app()->getLocale().'.json';

            if (! is_readable($translationFile)) {
                return [];
            }
        }

        return json_decode(file_get_contents($translationFile), true);
    }
}