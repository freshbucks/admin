<?php

namespace App\Admin\Forms\MarketingMessage;

use App\Models\MessageTemplate;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class EditMessageData extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '编辑短信内容';

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
        $id = ($this->all())['select-message-template']['id'];
        $template = MessageTemplate::find($id);
        $this->html($template->content, '短信模板');

        $params = preg_match_all('{\d}', $template->content);
        $this->hidden('template_id', $template->template_id);
        for ($i = 1; $i <= $params; $i++) {
            $item = $this->text('datas[]',"参数{{$i}}内容:");
            if ($i > 1) {
                $item->required();
            }
        }
    }
}
