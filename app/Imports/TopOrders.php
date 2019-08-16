<?php

namespace App\Imports;

use App\Models\TopOrder;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TopOrders implements ToModel, ShouldQueue, WithChunkReading
{
    use Importable;

    private $platform;

    /**
     * TopOrders constructor.
     * @param string $platform
     */
    public function __construct($platform = 'taobao')
    {
        $this->platform = $platform;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $address = explode(' ', $row[13], 4);

        return new TopOrder([
            //
            'platform' => $this->platform,
            'order_num' => $this->numToStr($row[0]), // 订单编号
            'nick_name' => $row[1], // 买家会员名
            'payment_account' => $row[2], // 买家支付宝账号
            'payment_should' => $row[3], // 买家应付货款
            'payment_shipping' => $row[4], // 买家应付邮费
            'payment_score' => $row[5], // 买家支付积分
            'payment_total' => $row[6], // 总金额
            'payment_end' => $row[8], // 买家实际支付金额
            'present_score' => $row[7], // 返点积分
            'payment_score_end' => $row[9], // 买家实际支付积分
            'order_status' => $row[10], // 订单状态
            'buyer_comment' => $row[11], // 买家留言
            'receiver_name' => $row[12], // 收货人姓名
            'receiver_state' => $address[0], // 收货地址 省
            'receiver_city' => $address[1], // 收货地址 市
            'receiver_town' => $address[2], // 收货地址 区
            'receiver_address' => $address[3], // 收货地址 详细地址
            'receiver_mobile' => $row[16], // 收货人手机
            'receiver_phone' => $row[15], // 收货人电话
            'order_time' => $this->fdt($row[17]), // 下单时间
            'payed_time' => $this->fdt($row[18]), // 付款时间
            'goods_name' => $row[19], // 商品标题
            'goods_type' => $row[20], // 商品种类
            'goods_num' => $row[24], // 商品数量
            'shipping_type' => $row[14], // 配送类型
            'shipping_name' => $row[22], // 物流公司
            'shipping_number' => $row[21], // 快递单号
            'memo' => $row[23], // 订单备注
            'shop_id' => $row[25], // 店铺ID
            'shop_name' => $row[26], // 店铺名称
            'receive_time' => $this->fdt($row[27]), // 确认收货时间
            'received_payment' => $row[28] // 结算金额
        ]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    private function numToStr($num)
    {
        $result = "";
        if (stripos($num, 'e') === false) {
            return $num;
        }
        while ($num > 0) {
            $v = $num - floor($num / 10) * 10;
            $num = floor($num / 10);
            $result = $v . $result;
        }
        return $result;
    }

    private function fdt($datetime)
    {
        if(!is_numeric($datetime)) {
            return null;
        }
        try {
            $timestamp = Date::excelToTimestamp($datetime);
            return Carbon::createFromTimestamp($timestamp);
        } catch (\Exception $exception) {
            return null;
        }
    }
}
