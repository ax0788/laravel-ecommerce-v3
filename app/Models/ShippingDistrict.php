<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingDistrict extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function country()
    {
        return $this->belongsTo(ShippingCountry::class, 'country_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(ShippingState::class, 'state_id', 'id');
    }
}