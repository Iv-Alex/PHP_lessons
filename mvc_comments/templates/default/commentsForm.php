<form id="comment-form" action="/add" method="post">
    <div class="row">
        <div class="col-lg-5 d-flex flex-column justify-content-between">
            <div class="mb-3">
                <label for="username" class="form-label fs-5">Имя <span class="text-danger">*</span></label>
                <input id="username" name="username" type="text" class="form-control" placeholder="nickname" aria-label="Username" value="<?= $_POST['username'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fs-5">E-Mail <span class="text-danger">*</span></label>
                <input id="email" name="email" type="email" class="form-control" placeholder="example@example.com" aria-describedby="emailHelp" value="<?= $_POST['email'] ?? '' ?>">
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6 mb-3">
            <label for="text" class="form-label fs-5">Комментарий <span class="text-danger">*</span></label>
            <textarea class="form-control" id="text" name="text" rows="6"><?= $_POST['text'] ?? '' ?></textarea>
        </div>
    </div>
    <div class="d-flex align-items-end">
        <div class="col-lg-7 mb-3">
            <div class="text-danger form-error"><?= $error ?? '' ?></div>
        </div>
        <div class="col-lg-5 text-end">
            <button type="submit" id="addComment" name="addComment" class="btn text-light fs-5 mt-5">Записать</button>
        </div>
    </div>
</form>