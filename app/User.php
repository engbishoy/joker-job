<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','photo','code_phone','phone','status','token_api','about_you','skills'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function service(){
        return $this->hasMany('App\Models\Service_work','user_id');
    }

    //معرض اعمالى 
    public function businessExhibition(){
        return $this->hasMany('App\Models\businessExhibition','user_id');
    }


    public function chat(){
        return $this->hasmany('App\Models\Chat');
    }

    public function order(){
        return $this->hasMany('App\Models\Order','user_id');
    }


    

    // requests received service for user
    
    public function receivedOrder(){
        return $this->hasManyThrough('App\Models\Order','App\Models\Service_work','user_id','service_work_id')->orderBy('created_at','DESC');
    }

    public function receivedOrderComplete(){
        return $this->hasManyThrough('App\Models\Order','App\Models\Service_work','user_id','service_work_id')->where('status',1)->orWhere('status',4)->orderBy('created_at','DESC');
    }

    public function receivedOrderRefusal(){
        return $this->hasManyThrough('App\Models\Order','App\Models\Service_work','user_id','service_work_id')->where('status',2)->orderBy('created_at','DESC');
    }

    public function receivedOrderCancel(){
        return $this->hasManyThrough('App\Models\Order','App\Models\Service_work','user_id','service_work_id')->where('status',3)->orderBy('created_at','DESC');
    }


    // attachment service user
    public function attachment(){
        return $this->hasMany('App\Models\Service_attachment','user_id');
    }


    // credit user
    public function credit(){
        return $this->hasOne('App\Models\Credit','user_id');
    }

    // رصيد معلق
    public function OutstandingCredit(){
        return $this->hasMany('App\Models\Pull_credit','user_id')->where('pull_status',0);
    }


    // ارباح تم سحبها
    public function Profits_withdrawn(){
        return $this->hasMany('App\Models\Pull_credit','user_id')->where('pull_status',1);
    }




    // tickets technical support

    public function ticket(){
        return $this->hasMany('App\Models\ticket','user_id');
    }

}
