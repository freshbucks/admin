<?php
namespace App\Models;

class VendorConfig extends Model
{
    public function vendor() {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }
}
