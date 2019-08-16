<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $res = preg_match_all('{\d}', '【绝对值】尊敬的{1}，您的{2}即将到期，查看{3}，退订回T');
        dump($res);

        $this->assertTrue(true);
    }
}
