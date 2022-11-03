<?php

namespace LaravelNovaLinear\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LaravelLinear\Models\LinearToken;
use LaravelLinear\Notifications\Messages\LinearIssue as LinearIssueMessage;
use LaravelLinear\Notifications\NewLinearIssue;
use LaravelNovaLinear\Facades\LaravelNovaLinear;
use LaravelNovaLinear\Models\LinearIssue;

class SubmitIssueToLinear implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public LinearIssue $linearIssue
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $submitter = $this->linearIssue->user_id ?? LinearToken::first()->user_id;
        $user = LaravelNovaLinear::models()->user::find($submitter);

        $issue = (new LinearIssueMessage)
            ->title($this->linearIssue->title)
            ->message($this->linearIssue->description)
            ->submitter($user->name);

        $this->linearIssue->getMedia('files')->each(function ($media) use (&$issue) {
            $issue = $issue->attachment($media->getUrl());
        });

        $user->notify(new NewLinearIssue($issue));
    }
}
