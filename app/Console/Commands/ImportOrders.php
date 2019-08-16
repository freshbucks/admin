<?php

namespace App\Console\Commands;

use App\Imports\TopOrders;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:import {file} {platform=taobao}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import orders';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->argument('file');
        Excel::import(new TopOrders($this->argument('platform')), $file);
    }
}
