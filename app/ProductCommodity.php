<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCommodity extends Model
{
    protected $table = 'product_commodity';

    protected $guarded = [];

    public function topic(){
        return $this->belongsTo('App\ProductTopic','topic_id');
    }

    public function plate(){
        return $this->belongsTo('App\ProductPlate','plate_id');
    }
    public function category(){
        return $this->belongsTo('App\ProductCategory','category_id');
    }

    // 与event table 一对一关系
    // public function status(){
    //     return $this->hasone('App\Event','product_commodity_id');
    // }

}
