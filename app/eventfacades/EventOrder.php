<?php

namespace App\eventfacades;

use Illuminate\Database\Eloquent\Model;

class EventOrder extends Model
{
    protected $table = 'event_orders';

    protected $guarded = [];

    public function details(){
        return $this->hasMany('App\eventfacades\EventOrderDetail','order_id','id');
    }

    public function follow(){
        return $this->belongsTo('App\WechatFollow','openid','openid');
    }
}
