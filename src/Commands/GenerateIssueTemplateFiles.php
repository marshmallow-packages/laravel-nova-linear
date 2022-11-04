<?php

namespace LaravelNovaLinear\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use LaravelNovaLinear\Facades\LaravelNovaLinear;

class GenerateIssueTemplateFiles extends Command
{
    public $signature = 'linear:generate-issue-templates';

    public $description = 'Generate issue template files for all available Linear tags.';

    public function handle(): int
    {
        $path = $this->createFolderPath();

        $this->generateTemplateFiles(
            path: $path,
        );

        $this->comment("All done. The template files can be found at the following location: {$path}");

        return self::SUCCESS;
    }

    protected function generateTemplateFiles(string $path): void
    {
        collect(LaravelNovaLinear::getIssueLabelsAsArray())->each(function ($label) use ($path) {
            $this->generateTemplateFile(
                label_slug: Str::of($label)->slug(),
                path: $path
            );
        });
    }

    protected function generateTemplateFile(string $label_slug, string $path): void
    {
        $template_title_name = Str::of($label_slug)->title()->replace('-', '');
        $template_method = "get{$template_title_name}Template";

        if (!file_exists("{$path}/{$label_slug}")) {
            $file = "{$path}/{$label_slug}.md";
            $fp = fopen($file, 'w');

            if (method_exists($this, $template_method)) {
                fwrite($fp, $this->{$template_method}());
            } else {
                fwrite($fp, '# New issue');
            }
            fclose($fp);
        }
    }

    protected function createFolderPath(): string
    {
        $path = base_path();
        collect(['.linear', 'ISSUE_TEMPLATE'])->each(function ($folder) use (&$path) {
            $path .= "/{$folder}";
            if (!file_exists($path)) {
                mkdir($path);
            }
        });

        return $path;
    }

    protected function getBugTemplate()
    {
        return <<<EOT
# We found a new bug

- Operating System and Version: #.#
- Browser type and version: #.#
- Please attach any available screenshots

### Description:

Type your description here...


### Detailed steps to reproduce the issue:

Type how we might be able to reproduce the issue here...
EOT;
    }

    protected function getIdeasTemplate()
    {
        return <<<EOT
# We have a new idea

Describe here new idea here...
EOT;
    }

    protected function getImprovementTemplate()
    {
        return <<<EOT
# We have a new improvement request

Describe here new improvement here...
EOT;
    }

    protected function getFeatureTemplate()
    {
        return <<<EOT
# We have a new feature request

Describe here new feature here...
EOT;
    }
}
