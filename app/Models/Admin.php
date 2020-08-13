<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use Notifiable;
    use LaratrustUserTrait;

    //
    protected $guard='admin';

    protected $fillable = [
        'name', 'email', 'password','phone','photo','code_phone','code_resetpassword','token_resetpassword',
    ];
}
