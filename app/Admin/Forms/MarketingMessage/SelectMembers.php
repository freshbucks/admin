<?php
namespace App\Admin\Forms\MarketingMessage;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class SelectMembers extends StepForm
{
    public $title = '选择收件人';
    private $order_status =  ['全部', '交易成功', '交易关闭'];

    public function handle(Request $request)
    {
        return $this->next($request->all());
    }

    public function form()
    {
//        $order_status = TopOrder::distinct('order_status')->get('order_status')->pluck('order_status');
        $this->text('goods_name', '商品名称')->placeholder('输入商品名称');
        $this->dateTimeRange('start_time', 'end_time', '下单时间');

        $this->select('order_status', '订单状态')->options($this->order_status);
    }

}
