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
     * @return bool
     */
    public function add(User $user, Certificate $certificate)
    {
        return !empty($user);
    }

}