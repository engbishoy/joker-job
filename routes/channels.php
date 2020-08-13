<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Admin.{id}', function ($admin, $id) {
    return (int) $admin->id === (int) $id;
    
},['guards'=> 'admin']);

Broadcast::channel('send.{id}', function () {
    return true;
});


Broadcast::channel('recieve.{id}', function () {
    return true;
});



Broadcast::channel('seen.{id}', function () {
    return true;
});

//online
Broadcast::channel('online', function ($user) {
    return $user;
});