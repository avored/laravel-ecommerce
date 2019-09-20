<?php

namespace App\ViewModels\Account;

use App\User;
use Spatie\ViewModels\ViewModel;

class EditViewModel extends ViewModel
{
    /**
     * Logged In User Model
     * @var \App\User $user
     */
    public $user;

    /**
     * Construct for the Account Edit View Model
     * @param \App\User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
