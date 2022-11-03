<?php

namespace LaravelNovaLinear\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelNovaLinear\Observers\LinearIssueObserver;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
