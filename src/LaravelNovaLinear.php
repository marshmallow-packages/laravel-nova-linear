<?php

namespace LaravelNovaLinear;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LaravelLinear\Models\LinearToken;

class LaravelNovaLinear
{
    public function models()
    {
        return (object) config('nova-linear.models');
    }

    public function getIssueLabelsAsArray()
    {
        $token = LinearToken::first();
        $ignore_labels = config('nova-linear.ignore_labels') ?? [];

        return collect($token->tags)->reject(function ($tag) use ($ignore_labels) {
            return in_array(Arr::get($tag, 'name'), $ignore_labels);
        })->mapWithKeys(function ($tag) {
            return [
                Arr::get($tag, 'id') =>
                Arr::get($tag, 'name')
            ];
        })->toArray();
    }

    public function getIssueTemplate($issue_label_id)
    {
        $token = LinearToken::first();
        $label = collect($token->tags)->where('id', $issue_label_id)->first();
        $label_name = Str::of(Arr::get($label, 'name'))->slug();

        $path = base_path(".linear/ISSUE_TEMPLATE/{$label_name}.md");
        if (file_exists($path)) {
            return file_get_contents($path);
        }

        return '';
    }
}
