<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable=['user_id','service_work_id','payed_id','price','taxes','total_price','sale_service_approve','status','expire_time_sale_approve','expire_time_sale_attachment','expire_time_buyer_approve'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function service(){
        return $this->belongsTo('App\Models\Service_work','service_work_id');
    }

    public function attachment(){
        return $this->hasMany('App\Models\Service_attachment','order_id');

    }

    public function getLastAttachment(){
        return $this->hasOne('App\Models\Service_attachment','order_id')->orderBy('id','DESC')->take(1);
    }
}
