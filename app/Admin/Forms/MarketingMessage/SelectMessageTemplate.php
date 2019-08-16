<?php

namespace App\Admin\Forms\MarketingMessage;

use App\Models\MessageTemplate;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class SelectMessageTemplate extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '选择短信模板';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        return $this->next($request->all());
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $templates = MessageTemplate::all();
        $this->select('id', '短信模板ID')
            ->options($templates->pluck('name', 'id'))
            ->required();
    }
}
