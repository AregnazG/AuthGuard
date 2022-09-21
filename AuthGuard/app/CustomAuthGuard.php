<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CustomAuthGuard implements Guard
{
    public $request;
    private $provider;
    private $user;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->request = $request;
        $this->provider = $provider;
    }

    public function check()
    {
        return isset($this->user);
    }

    public function guest()
    {
        return !isset($this->user);
    }

    public function hasUser()
    {
        return isset($this->user);
    }

    public function user()
    {
        if (isset($this->user)) {
            return $this->user;
        }
    }

    public function id()
    {
        if (isset($this->user)) {
            return $this->user->getAuthIdentifier();
        }
    }

    public function validate(array $credentials = [])
    {
        if (!isset($credentials['username']) || empty($credentials['username']) || !isset($credentials['password']) || empty($credentials['password'])) {
            return false;
        }

        $user = $this->provider->retrieveById($credentials['username']);
        if (!isset($user)) {
            return false;
        }

        if ($this->provider->validateCredentials($user, $credentials)) {
            $this->setUser($user);
            return true;
        } else {
            return false;
        }
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
    }
}
