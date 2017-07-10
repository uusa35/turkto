<?php
namespace App\Observers;

use App\Mail\ActivationRequest;
use App\Notifications\UserActivate;
use App\User;

/**
 * Created by PhpStorm.
 * User: usamaahmed
 * Date: 7/10/17
 * Time: 1:31 PM
 */
class UserObserver
{
    /**
     * Handle user logout events.
     */
    public function created(User $user)
    {
        // create secret activation
        $user->update(['secret' => rand(9999, 99999999999)]);
        // send the email
        $user->notify(new UserActivate($user));
    }

}