<?php

namespace LaravelNovaLinear;

class LaravelNovaLinear
{
    public function models()
    {
        return (object) config('nova-linear.models');
    }
}
