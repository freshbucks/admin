<?php
namespace App\Models;

class Vendor extends Model
{
    public function configs() {
        return $this->hasMany('App\Models\VendorConfig', 'vendor_id');
    }

    public function templates() {
        return $this->hasMany('App\Models\MessageTemplate', 'vendor_id');
    }
}
