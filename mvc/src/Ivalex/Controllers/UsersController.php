<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Users\User;
use Ivalex\Models\Users\UsersAuthService;
use Ivalex\Exceptions\BadValueException;

class UsersController extends BasicController
{

    public function signUp()
    {
        if (isset($_POST['signup'])) {
            try {
                $user = User::signUp([
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                ]);
            } catch (BadValueException $e) {
                $this->view->renderHtml('signUp.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('signUp.php');
    }

    public function login()
    {
        if (isset($_POST['login'])) {
            try {
                $user = User::login([
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                ]);
                UsersAuthService::createToken($user);
                // go to home page
                header('Location: /');
                exit();
            } catch (BadValueException $e) {
                $this->view->renderHtml('login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('login.php');
    }

    public function logout()
    {
        // remove AuthToken for logout
        UsersAuthService::removeToken();
        // go to home page
        header('Location: /');
        exit();
    }
}
