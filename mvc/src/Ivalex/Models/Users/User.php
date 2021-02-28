<?php

namespace Ivalex\Models\Users;

use Ivalex\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity
{
    protected $id;
    protected $name;
    protected $email;
    protected $pwdHash;
    protected $role;

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * contract
     */
    protected static function getTableName(): string
    {
        return 'users';
    }
}
