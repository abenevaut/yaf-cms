<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use Illuminate\Translation\{ArrayLoader, Translator};
use Illuminate\Validation\Factory;

final class ValidationProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $this->singleton(Factory::class, static function () {
            $validationTranslations = require __DIR__ . '/../../vendor/illuminate/translation/lang/en/validation.php';
            $translations = (new ArrayLoader())->addMessages('en', 'validation', $validationTranslations);
            return new Factory(new Translator($translations, 'en'));
        });

        return $this;
    }
}
