<?php

namespace Ivalex\Controllers;

use Ivalex\Models\Users\User;
use Ivalex\Models\Users\UsersAuthService;
use Ivalex\Exceptions\BadValueException;
use Ivalex\Views\View;

class UsersController extends BasicController
{

    public function signUp()
    {
        if (isset($_POST['signup'])) {
            try {
                // will use Prepared Statements to insert data into SQL query
                $user = User::signUp([
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => $_POST['psswrd'],
                ]);
                // go to the login page and inform about successful registration
                header('Location: /users/login/message/0');
                exit();
            } catch (BadValueException $e) {
                $this->view->renderHtml('signUp.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('signUp.php');
    }

    public function login(int $messageId = null)
    {
        if (isset($_POST['login'])) {
            try {
                // will use Prepared Statements to insert data into SQL query
                $user = User::login([
                    'username' => $_POST['username'],
                    'password' => $_POST['psswrd'],
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

        if ($messageId !== null) {
            $this->view->setVar('success', View::getMessage('USER_' . $messageId));
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
