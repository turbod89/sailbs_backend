<?php

namespace App\Policies;

use App\User;
use App\Certificate;

class CertificatePolicy
{
    /**
     * Determine if the given certificate can be added to user certificates.
     *
     * @param  \App\User  $user
     * @param  \App\Certificate  $certificate
     * @param  \App\User  $user_target
     * @return bool
     */
    public function add(User $user, Certificate $certificate, User $user_target)
    {
        return $user->hasRole(['admin','coordinator']) || $user->id === $user_target->id;
    }

    /**
     * Determine if the given certificate can be removed to user certificates.
     *
     * @param  \App\User  $user
     * @param  \App\Certificate  $certificate
     * @param  \App\User  $user_target
     * @return bool
     */
    public function remove(User $user, Certificate $certificate, User $user_target)
    {
        return self::add($user,$certificate,$user_target);
    }

}