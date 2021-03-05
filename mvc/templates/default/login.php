<?php include __DIR__ . '/header.php'; ?>
<div class="d-flex justify-content-center align-items-center">
    <main class="col-md-4 p-3">
        <h1>Вход</h1>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert"><?= $error ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">* Имя пользователя (nickname)</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input id="username" name="username" type="text" class="form-control" placeholder="nickname" aria-label="Username" value="<?= $_POST['username'] ?? '' ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">* Пароль</label>
                <input id="passord" name="password" type="password" class="form-control" value="<?= $_POST['password'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <div class="form-text">* - обязательные к заполнению поля</div>
            </div>
            <div class="text-center">
                <a href="/users/register" class="btn btn-link">Зарегистрироваться</a>
                <button type="submit" name="login" class="btn btn-primary">Войти</button>
                <div>
                    <a href="/">Вернуться на главную</a>
                </div>
            </div>
        </form>
    </main>
</div>
<?php include __DIR__ . '/footer.php'; ?>