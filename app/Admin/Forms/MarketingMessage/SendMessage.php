<?php
namespace App\Admin\Forms\MarketingMessage;

use App\Models\TopOrder;
use Carbon\Carbon;
use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;

class SendMessage extends StepForm
{
    public $title = '发送信息';
    private $order_status = ['全部', '交易成功', '交易关闭'];
    private $mobiles;

    public function handle(Request $request)
    {
        $this->mobiles->pluck('receiver_mobile');
        dump($request->all());
        return $this->clear();
    }

    public function form()
    {
        $this->selectMembers();

        $this->text('coupon', '优惠券链接')->placeholder('输入优惠券链接');
        $this->textarea('message', '信息内容')->placeholder('输入短信内容');
        $this->html('短信内容中需要替换的内容使用#替换内容#替代，目前仅支持#商品#,#顾客#,#优惠券链接#三个，如：');
        $this->html('尊敬的#顾客#,您有一张80元优惠券待领取，戳此领取#优惠券链接#');
    }

    private function selectMembers() {
        $input = $this->all()['select-members'];
        $data = $this->mobiles = TopOrder::where(function ($query) use ($input) {
            $query->whereNotNull('receiver_mobile');
            if ($input['goods_name']) {
                $query->where('goods_name', 'like', '%'.$input['goods_name'].'%');
            }
            if ($input['order_status'] > 0) {
                $query->where('order_status', $this->order_status[$input['order_status']]);
            }
            if ($input['start_time'] && $input['end_time']) {
                $query->whereBetween('order_time', [
                    $input['start_time'],
                    $input['end_time']
                ]);
            }
        })->distinct('receiver_mobile')->get(['receiver_mobile']);

        $this->html('您已选择'.$data->count().'条买过【'.$input['goods_name'].'】的手机号！');
    }
}
