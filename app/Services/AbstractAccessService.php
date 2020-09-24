<?php

namespace App\Services;

use App\Traits\FilterConstantsTrait;
use App\User;

abstract class AbstractAccessService
{
    use FilterConstantsTrait;

    public const ACCESS_TYPE_PUBLIC = 'public';
    public const ACCESS_TYPE_PROTECTED = 'protected';
    public const ACCESS_TYPE_PRIVATE = 'private';

    /**
     * @var User|null
     */
    protected ? User $user = null;

    /**
     * AbstractAccessService constructor.
     */
    public function __construct()
    {
        if ( ! $this->user) {
            $this->user = auth()->user();
        }
    }

    /**
     * @return array
     */
    public static function getAccessTypes() : array
    {
        return static::filterConstants("ACCESS_TYPE");
    }

    /**
     * @param User|null $user
     */
    public function setUser( ? User $user) : void
    {
        $this->user = $user;
    }

    /**
     * @return User|null
     */
    public function getUser() : ? User
    {
        return $this->user;
    }

}
