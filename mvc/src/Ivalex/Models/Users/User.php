<?php

namespace Ivalex\Models\Users;

use Ivalex\Models\ActiveRecordEntity;
use Ivalex\Exceptions\BadValueException;

class User extends ActiveRecordEntity
{
    protected $name;
    protected $email;
    protected $pwdHash;
    protected $role;
    protected $authToken;

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

    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    public static function signUp(array $userData): User
    {
        if (empty($userData['username'])) {
            throw new BadValueException('Не передано имя пользоателя');
        }
        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['username'])) {
            throw new BadValueException('Nickname может состоять только из символов латинского алфавита и цифр');
        }
        if (static::findOneByColumn('name', $userData['username']) !== null) {
            throw new BadValueException('Пользователь с таким nickname уже существует');
        }
        if (!empty($userData['email'])) {
            if (static::findOneByColumn('email', $userData['email']) !== null) {
                throw new BadValueException('Пользователь с таким email уже существует');
            }
        }
        if (empty($userData['password'])) {
            throw new BadValueException('Не введен пароль');
        }
        if (mb_strlen($userData['password']) < 3) {
            throw new BadValueException('Пароль должен быть не менее 3 символов');
        }

        $user = new User();
        $user->name = $userData['username'];
        $user->email = $userData['email'];
        $user->pwdHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;
    }

    public static function login(array $loginData): User
    {

        if (empty($loginData['username'])) {
            throw new BadValueException('Не передано имя пользоателя');
        }
        if (empty($loginData['password'])) {
            throw new BadValueException('Не передан password');
        }
        $user = User::findOneByColumn('name', $loginData['username']);
        if ($user === null) {
            throw new BadValueException('Нет пользователя с таким именем');
        }
        if (!password_verify($loginData['password'], $user->getPwdHash())) {
            throw new BadValueException('Неправильный пароль');
        }

        // update AuthToken on every successful login
        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    public function getPwdHash(): string
    {
        return $this->pwdHash;
    }

    private function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }

    /**
     * contract
     */
    protected static function getTableName(): string
    {
        return 'users';
    }
}
