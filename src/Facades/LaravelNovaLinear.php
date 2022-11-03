<?php

namespace LaravelNovaLinear\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelNovaLinear extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaravelNovaLinear\LaravelNovaLinear::class;
    }
}
