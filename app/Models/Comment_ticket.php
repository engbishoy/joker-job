<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment_ticket extends Model
{
    //
    protected $fillable=['user_id','admin_id','ticket_id','message','attachment','is_admin'];

    public function ticket(){
        return $this->belongsTo('App\Models\ticket','ticket_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function admin(){
        return $this->belongsTo('App\Models\Admin','admin_id');
    }
}
