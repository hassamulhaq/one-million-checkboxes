<?php

use Illuminate\Support\Facades\Broadcast;

/*Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});*/

/**
 * channel is open for guest users
 */
Broadcast::channel('checkboxes', function (\App\Models\User $user) {
   return true;
});
