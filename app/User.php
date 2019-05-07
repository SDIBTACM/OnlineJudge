<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use App\Models\User as UserModel;
use Illuminate\Support\Carbon;

class User extends UserModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract

//If you think you must confirm each email address, please uncomment the next line.
//,MustVerifyEmailContract
{
    use Notifiable;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return $this->email_verified_at->timestamp != Carbon::createFromTimeString('0000-00-00 00:00:00')->timestamp;
    }

}
