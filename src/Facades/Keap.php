<?php

namespace DmitryChurkin\Keap\Facades;

use Illuminate\Support\Facades\Facade;
use DmitryChurkin\Keap\Contracts\Keap as KeapContract;

final class Keap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return KeapContract::class;
    }
}
