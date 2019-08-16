<?php
namespace App\Models;

class MessageTemplate extends Model
{
    //
    public function vendor() {
        $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }
}
