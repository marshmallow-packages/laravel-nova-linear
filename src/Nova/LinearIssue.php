<?php

namespace LaravelNovaLinear\Nova;

use App\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use LaravelNovaLinear\Facades\LaravelNovaLinear;


class LinearIssue extends Resource
{
    public static $model = \LaravelNovaLinear\Models\LinearIssue::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $fields = [
            ID::make()->sortable(),
            Text::make(__('Title'), 'title')->required()->rules(['required']),
        ];

        if (config('nova-linear.use_labels')) {
            $fields = array_merge($fields, [
                Select::make(__('Label'), 'issue_label_id')->required()->rules(['required'])->options(
                    LaravelNovaLinear::getIssueLabelsAsArray()
                ),
                Markdown::make(__('Description'), 'description')->alwaysShow()
                    ->hide()
                    ->dependsOn(
                        ['issue_label_id'],
                        function (Markdown $field, NovaRequest $request, FormData $formData) {
                            if ($formData->issue_label_id) {
                                $field->show()->withMeta([
                                    'value' => $this->description ?? LaravelNovaLinear::getIssueTemplate($formData->issue_label_id),
                                ]);
                            }
                        }
                    ),
            ]);
        } else {
            $fields = array_merge($fields, [
                Markdown::make(__('Description'), 'description')->alwaysShow(),
            ]);
        }

        return array_merge($fields, [
            Files::make(__('Files'), 'files')
                ->hideFromIndex(),
        ]);
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
