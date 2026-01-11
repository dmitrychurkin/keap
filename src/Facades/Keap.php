<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Facades;

use DmitryChurkin\Keap\Contracts\Keap as KeapContract;
use Illuminate\Support\Facades\Facade;

final class Keap extends Facade
{
    protected static function getFacadeAccessor()
    {
        return KeapContract::class;
    }
}
