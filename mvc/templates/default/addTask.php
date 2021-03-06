<?php include __DIR__ . '/header.php'; ?>
<div class="d-flex justify-content-center align-items-center">
    <main class="container">
        <h1><?= $header ?? '' ?></h1>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert"><?= $error ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">* Имя пользователя (nickname)</label>
                    <div class="input-group mb-6">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input id="username" name="username" type="text" class="form-control" placeholder="nickname" aria-label="Username" value="<?= $_POST['username'] ?? '' ?>" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">* Адрес e-mail</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="example@example.com" aria-describedby="emailHelp" value="<?= $_POST['email'] ?? '' ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">* Текст задачи</label>
                <textarea class="form-control" id="text" name="text" rows="3" required><?= $_POST['text'] ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <div class="form-text">* - обязательные к заполнению поля</div>
            </div>
            <div class="text-center">
                <button type="submit" name="addtask" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </main>
</div><?php include __DIR__ . '/footer.php'; ?>