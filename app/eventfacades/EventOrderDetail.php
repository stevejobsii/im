<?php

namespace App\eventfacades;

use Illuminate\Database\Eloquent\Model;

class EventOrderDetail extends Model
{
    protected $table = 'event_order_details';

    protected $guarded = [];

    public function order(){
        return $this->belongsTo('App\eventfacades\EventOrder','order_id','id');
    }

}
