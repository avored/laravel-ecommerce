<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class RegisterUserEvent {

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered  $event
     * @return void
     */
    public function handle(UserWasRegistered $event) {
        $user = $event->user;
        Mail::send('default.emails.register', ['user' => $user], function ($m) use ($user) {
            $m->from('to@website1.comeerce', 'My Name');

            $m->to($user->email, $user->name)->subject('User Registration');
            //mail($user->email,'sub','body');
        });
    }

}
