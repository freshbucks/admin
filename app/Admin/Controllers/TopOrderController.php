<?php

namespace App\Admin\Controllers;

use App\Models\TopOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TopOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '阿里订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TopOrder);

        $grid->quickSearch();
        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();

            $filter->scope('taobao', '淘宝')->where('platform', 'taobao');
            $filter->scope('tmall', '天猫')->where('platform', 'tmall');
        });

        $grid->column('id', __('ID'));
        $grid->column('platform', __('平台'))->filter([
            'taobao'    => '淘宝',
            'tmall'     => '天猫'
        ]);
//        $grid->column('order_num', __('Order num'));
//        $grid->column('nick_name', __('昵称'));
        $grid->column('receiver_name', __('姓名'));
        $grid->column('receiver_mobile', __('电话'))->display(function ($value) {
            return substr($value, 1);
        });
//        $grid->column('payment_account', __('Payment account'));
//        $grid->column('payment_should', __('Payment should'));
//        $grid->column('payment_shipping', __('Payment shipping'));
//        $grid->column('payment_score', __('Payment score'));
//        $grid->column('payment_total', __('Payment total'));
//        $grid->column('payment_end', __('Payment end'));
//        $grid->column('present_score', __('Present score'));
//        $grid->column('payment_score_end', __('Payment score end'));
//        $grid->column('order_status', __('Order status'));
//        $grid->column('buyer_comment', __('Buyer comment'));
        $grid->column('receiver_state', __('省'))->filter();
        $grid->column('receiver_city', __('市'))->filter();
        $grid->column('receiver_town', __('区'));
        $grid->column('receiver_address', __('详细地址'));
//        $grid->column('receiver_phone', __('Receiver phone'));
//        $grid->column('goods_name', __('Goods name'));
//        $grid->column('goods_type', __('Goods type'));
//        $grid->column('goods_num', __('Goods num'));
//        $grid->column('shipping_type', __('Shipping type'));
//        $grid->column('shipping_name', __('Shipping name'));
//        $grid->column('shipping_number', __('Shipping number'));
//        $grid->column('memo', __('Memo'));
//        $grid->column('shop_id', __('Shop id'));
//        $grid->column('shop_name', __('Shop name'));
        $grid->column('received_payment', __('金额'));
        $grid->column('order_time', __('下单时间'))->filter('range', 'datetime');;
//        $grid->column('payed_time', __('支付时间'));
//        $grid->column('receive_time', __('收货时间'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(TopOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('platform', __('Platform'));
        $show->field('order_num', __('Order num'));
        $show->field('nick_name', __('Nick name'));
        $show->field('payment_account', __('Payment account'));
        $show->field('payment_should', __('Payment should'));
        $show->field('payment_shipping', __('Payment shipping'));
        $show->field('payment_score', __('Payment score'));
        $show->field('payment_total', __('Payment total'));
        $show->field('payment_end', __('Payment end'));
        $show->field('present_score', __('Present score'));
        $show->field('payment_score_end', __('Payment score end'));
        $show->field('order_status', __('Order status'));
        $show->field('buyer_comment', __('Buyer comment'));
        $show->field('receiver_name', __('Receiver name'));
        $show->field('receiver_state', __('Receiver state'));
        $show->field('receiver_city', __('Receiver city'));
        $show->field('receiver_town', __('Receiver town'));
        $show->field('receiver_address', __('Receiver address'));
        $show->field('receiver_mobile', __('Receiver mobile'));
        $show->field('receiver_phone', __('Receiver phone'));
        $show->field('goods_name', __('Goods name'));
        $show->field('goods_type', __('Goods type'));
        $show->field('goods_num', __('Goods num'));
        $show->field('shipping_type', __('Shipping type'));
        $show->field('shipping_name', __('Shipping name'));
        $show->field('shipping_number', __('Shipping number'));
        $show->field('memo', __('Memo'));
        $show->field('shop_id', __('Shop id'));
        $show->field('shop_name', __('Shop name'));
        $show->field('received_payment', __('Received payment'));
        $show->field('order_time', __('Order time'));
        $show->field('payed_time', __('Payed time'));
        $show->field('receive_time', __('Receive time'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TopOrder);

        $form->text('platform', __('Platform'));
        $form->text('order_num', __('Order num'));
        $form->text('nick_name', __('Nick name'));
        $form->text('payment_account', __('Payment account'));
        $form->text('payment_should', __('Payment should'));
        $form->text('payment_shipping', __('Payment shipping'));
        $form->text('payment_score', __('Payment score'));
        $form->text('payment_total', __('Payment total'));
        $form->text('payment_end', __('Payment end'));
        $form->text('present_score', __('Present score'));
        $form->text('payment_score_end', __('Payment score end'));
        $form->text('order_status', __('Order status'));
        $form->text('buyer_comment', __('Buyer comment'));
        $form->text('receiver_name', __('Receiver name'));
        $form->text('receiver_state', __('Receiver state'));
        $form->text('receiver_city', __('Receiver city'));
        $form->text('receiver_town', __('Receiver town'));
        $form->textarea('receiver_address', __('Receiver address'));
        $form->text('receiver_mobile', __('Receiver mobile'));
        $form->text('receiver_phone', __('Receiver phone'));
        $form->textarea('goods_name', __('Goods name'));
        $form->text('goods_type', __('Goods type'));
        $form->text('goods_num', __('Goods num'));
        $form->text('shipping_type', __('Shipping type'));
        $form->text('shipping_name', __('Shipping name'));
        $form->text('shipping_number', __('Shipping number'));
        $form->textarea('memo', __('Memo'));
        $form->text('shop_id', __('Shop id'));
        $form->text('shop_name', __('Shop name'));
        $form->text('received_payment', __('Received payment'));
        $form->datetime('order_time', __('Order time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('payed_time', __('Payed time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('receive_time', __('Receive time'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
