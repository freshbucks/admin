<?php

namespace Tests\Feature;

use App\Imports\TopOrders;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeTest extends TestCase
{
    private $flag = 0;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCarbon()
    {
//        if ($this->flag > 0) die;
//        $this->flag++;
//        $array = Excel::toArray(new TopOrders(), storage_path('sources/Taobao.xlsx'));
//        dd($array[0][0]);


        $n1904 = Carbon::create(1900);
        $n1970 = Carbon::create(1970);
        $d1 = $n1970->diffInSeconds($n1904);

        $d = 25569;
        $o = 43512.967731481; // 2019/2/16 23:13:32
        $p = 43512.96775463;  // 2019/2/16 23:13:34
        $r = 43525.5146875;   // 2019/3/1 12:21:09
        $time = Carbon::createFromTimeString('2019-02-16 23:13:32');
        $ts = ($o * 24 * 60 * 60 - $d1) * 1000;

        $dt = Carbon::createFromTimestamp(Date::excelToTimestamp($o, config('app.timezone')));

        $diff = $time->diffInMicroseconds($dt);
        dd($time, $dt, $diff, config('app.timezone'));

        die;
    }
}
