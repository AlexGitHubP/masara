<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ClientAccount extends Model implements Authenticatable{
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        // Retrieve the password from the associated user
        $user = $this->user()->first();
        return $user ? $user->password : null;
    }

    public function getRememberToken()
    {
        return $this->user()->first()->getRememberToken();
    }

    public function setRememberToken($value)
    {
        $this->user()->first()->setRememberToken($value);
    }

    public function getRememberTokenName()
    {
        return $this->user()->first()->getRememberTokenName();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
