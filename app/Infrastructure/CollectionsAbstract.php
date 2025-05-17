<?php

namespace App\Infrastructure;

use Illuminate\Support\Collection;

abstract class CollectionsAbstract extends Collection implements CollectionInterface
{
    public function get($key, $default = null)
    {
        return parent::get($key, $default);
    }
}
