<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('platform');
            $table->string('order_num')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('payment_account')->nullable();
            $table->string('payment_should')->nullable();
            $table->string('payment_shipping')->nullable();
            $table->string('payment_score')->nullable();
            $table->string('payment_total')->nullable();
            $table->string('payment_end')->nullable();
            $table->string('present_score')->nullable();
            $table->string('payment_score_end')->nullable();
            $table->string('order_status')->nullable();
            $table->string('buyer_comment')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_state')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_town')->nullable();
            $table->text('receiver_address')->nullable();
            $table->string('receiver_mobile')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->text('goods_name')->nullable();
            $table->string('goods_type')->nullable();
            $table->string('goods_num')->nullable();
            $table->string('shipping_type')->nullable();
            $table->string('shipping_name')->nullable();
            $table->string('shipping_number')->nullable();
            $table->text('memo')->nullable()->nullable();
            $table->string('shop_id')->nullable();
            $table->string('shop_name')->nullable();
            $table->string('received_payment')->nullable();
            $table->timestamp('order_time')->useCurrent();
            $table->timestamp('payed_time')->useCurrent();
            $table->timestamp('receive_time')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_orders');
    }
}
