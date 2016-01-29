<?php

namespace App\Http\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;


class Api extends Model implements
AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    protected  $user;
    protected  $email;
    protected  $password;


    /**
     * @param array $user
     */
    public  function __construct($user){
        $this->user = $user;
        $this->email = $user->email;
        $this->password = $user->password;
    }

    /**
     * @return array
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param array $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }





}
