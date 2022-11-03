<?php

namespace LaravelNovaLinear\Observers;

use LaravelNovaLinear\Models\LinearIssue;
use LaravelNovaLinear\Jobs\SubmitIssueToLinear;

class LinearIssueObserver
{
    public function creating(LinearIssue $linearIssue)
    {
        if (auth()->id()) {
            $linearIssue->user_id = auth()->id();
        }
    }

    public function created(LinearIssue $linearIssue)
    {
        SubmitIssueToLinear::dispatch($linearIssue);
    }
}
