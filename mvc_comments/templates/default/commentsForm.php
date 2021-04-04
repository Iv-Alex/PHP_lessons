<form id="comment-form" action="/add" method="post" class="needs-validation">
    <div class="row">
        <div class="col-lg-5 d-flex flex-column justify-content-between">
            <div class="mb-3">
                <label for="username" class="form-label fs-5">Имя <span class="text-danger">*</span></label>
                <input id="username" name="username" type="text" class="form-control" aria-label="Username" value="<?= $_POST['username'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fs-5">E-Mail <span class="text-danger">*</span></label>
                <input id="email" name="email" type="email" class="form-control" aria-describedby="emailHelp" value="<?= $_POST['email'] ?? '' ?>" required>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6 mb-3">
            <label for="text" class="form-label fs-5">Комментарий <span class="text-danger">*</span></label>
            <textarea class="form-control" id="text" name="text" rows="6" required><?= $_POST['text'] ?? '' ?></textarea>
        </div>
    </div>
    <div class="d-md-flex justify-content-between align-items-end">
        <div class="col-lg-7">
            <div class="form-message"><?= isset($error) ? "<div class=\"text-danger\">$error</div>" : "" ?></div>
        </div>
        <div class="col-lg-5 text-end">
            <button type="submit" id="addComment" name="addComment" class="btn btn-danger fs-5 mt-4">Записать</button>
        </div>
    </div>
</form>