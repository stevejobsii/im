<?php

namespace App\eventfacades;

use Illuminate\Database\Eloquent\Model;

class EventCart extends Model
{
    protected $table = 'event_cart';

    protected $guarded = [];

    public function commodity()
    {
        return $this->hasOne('App\eventfacades\EventCommodity', 'id', 'commodity_id');
    }

}
