<?php include __DIR__ . '/header.php'; ?>
<div class="d-flex justify-content-center align-items-center">
    <main class="container">
        <h1 class="display-6">Редактирование задачи #<?= $task->getId() ?></h1>
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger" role="alert"><?= $error ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Имя пользователя (nickname)</label>
                    <div class="input-group mb-6">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input id="username" name="username" type="text" class="form-control" placeholder="nickname" aria-label="Username" value="<?= $task->getName() ?>" disabled>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Адрес e-mail</label>
                    <input id="email" name="email" type="email" class="form-control" placeholder="example@example.com" aria-describedby="emailHelp" value="<?= $task->getEmail() ?>" disabled>
                </div>
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">* Текст задачи</label>
                <textarea class="form-control" id="text" name="text" rows="3" required><?= $_POST['text'] ?? $task->getText() ?></textarea>
            </div>
            <div class="mb-3">
                <?php foreach ($task->getStatus(true) as $status) : ?>
                    <?php if ($status->setting != 'unactive') : ?>
                        <?php if ($status->setting == 'in_form') : ?>
                            <div class="form-check">
                                <input class="form-check-input" name="status[]" type="checkbox" value="<?= $status->id ?>" id="chbox<?= $status->id ?>" <?= ($status->checked) ? ' checked' : '' ?>>
                                <label class="form-check-label" for="chbox<?= $status->id ?>">
                                    <?= $status->status ?>
                                </label>
                            </div>
                        <?php elseif ($status->checked) : ?>
                            <div class="form-check">
                                <input class="form-check-input" name="status[]" type="checkbox" value="<?= $status->id ?>" id="chbox<?= $status->id ?>" hidden checked>
                                <label class="form-check-label badge rounded-pill bg-success bg-gradient text-light m-1" for="chbox<?= $status->id ?>">
                                    <?= $status->status ?>
                                </label>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="mb-3">
                <div class="form-text">* - обязательные к заполнению поля</div>
            </div>
            <div class="text-center">
                <button type="submit" name="updatetask" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
        <div>
            <a href="/">Вернуться на главную</a>
        </div>
    </main>
</div><?php include __DIR__ . '/footer.php'; ?>