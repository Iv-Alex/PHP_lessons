<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

</head>

<body>
    <div class="container col-xl-10">
        <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm">
            <a class="my-0 me-md-auto fw-normal text-decoration-none" href="/">
                <span class="h4">BeeJee</span>
                <span class="h6">Test</span>
            </a>
            <div class="my-2 my-md-0 me-md-3">
                <?php if (!empty($user)) : ?>
                    <span class="p-2 text-dark">Здравствуйте, <?= $user->getName() ?></span>
                    <a class="p-2 text-dark" href="/users/logout">Выйти</a>
                    <a class="p-2 text-dark" href="/users/login">Сменить пользователя</a>
                <?php else : ?>
                    <a class="p-2 text-dark" href="/users/register">Зарегистрироваться</a>
                    <a class="p-2 text-dark" href="/users/login">Войти</a>
                <?php endif; ?>
            </div>
        </header>