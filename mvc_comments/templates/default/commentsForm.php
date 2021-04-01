<form action="/add" method="post">
    <?= $error ?? '' ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="username" class="form-label">* Имя пользователя (nickname)</label>
            <div class="input-group mb-6">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input id="username" name="username" type="text" class="form-control" placeholder="nickname" aria-label="Username" value="<?= $_POST['username'] ?? '' ?>">
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">* Адрес e-mail</label>
            <input id="email" name="email" type="email" class="form-control" placeholder="example@example.com" aria-describedby="emailHelp" value="<?= $_POST['email'] ?? '' ?>">
        </div>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">* Комментарий</label>
        <textarea class="form-control" id="text" name="text" rows="3"><?= $_POST['text'] ?? '' ?></textarea>
    </div>
    <div class="mb-3">
        <div class="form-text">* - обязательные к заполнению поля</div>
    </div>
    <div class="text-center">
        <button type="submit" name="addComment" class="btn btn-primary">Сохранить</button>
    </div>
</form>