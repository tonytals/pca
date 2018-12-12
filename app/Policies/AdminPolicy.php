<?php

namespace ProntuarioEletronico\Policies;

use ProntuarioEletronico\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->eAdmin()) {
            return true;
        }
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
