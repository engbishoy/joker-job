<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class Service_work extends Model
{
    //
    protected $table='service_works';
    protected $fillable=['title','description','price','tags','time_execute','photos','category_id','section_id','user_id','approve','viewer'];
    

    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    

    // views many to many
    public function views(){
        return $this->belongsToMany('App\User', 'view_service', 'service_work_id', 'user_id');
    }


    public function order(){
        return $this->hasMany('App\Models\Order','service_work_id');
    }
    
    public function completedSale(){
        return $this->hasMany('App\Models\Order','service_work_id')->where('status',4)->orWhere('status',1);
    }

    public function canceledSale(){
        return $this->hasMany('App\Models\Order','service_work_id')->where('status',3)->orWhere('status',2);
    }


    public function evaluation(){
        return $this->hasMany('App\Models\Evaluation','service_work_id');
    }


    // top rated 
    public function topRate(){
        return $this->hasMany('App\Models\Evaluation','service_work_id')->orderBy('evaluation','desc');
    }
}
