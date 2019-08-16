<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\MarketingMessage\EditMessageData;
use App\Admin\Forms\MarketingMessage\SelectMembers;
use App\Admin\Forms\MarketingMessage\SelectMessageTemplate;
use App\Admin\Forms\MarketingMessage\SendMessage;
use App\Http\Controllers\Controller;
use App\Models\TopOrder;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\MultipleSteps;
use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

class MarketingController extends Controller
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '营销中心';

    public function index(Content $content) {
        $data = TopOrder::whereNotNull('receiver_mobile')->groupBy('receiver_mobile')
            ->get(['receiver_mobile', DB::raw('count(*) as num')]);
        return $content
            ->title('用户概览')
            ->body(new Table(['手机号', '购买次数'],$data->toArray()));
    }

    public function sms(Content $content) {
        $steps = [
            'select-message-template' => SelectMessageTemplate::class,
            'edit-message-data' => EditMessageData::class,
            'select-members' => SelectMembers::class,
        ];
        return $content
            ->title('短信营销')
            ->body(MultipleSteps::make($steps));
    }
}
