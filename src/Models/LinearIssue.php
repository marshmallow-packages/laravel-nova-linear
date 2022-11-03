<?php

namespace LaravelNovaLinear\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use LaravelNovaLinear\Observers\LinearIssueObserver;

class LinearIssue extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::observe(LinearIssueObserver::class);
    }
}
