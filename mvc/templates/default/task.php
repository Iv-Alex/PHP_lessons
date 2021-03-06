<?php include __DIR__ . '/header.php'; ?>
<div class="container-fluid">
    <main class="p-3">
        <?php if (!empty($success)) : ?>
            <div class="alert alert-success" role="alert"><?= $success ?></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <div><?= $task->getName() ?></div>
                        <div><?= $task->getEmail() ?></div>
                    </div>
                    <div class="col-md-6">
                        <?php foreach ($task->getStatus() as $status) : ?>
                            <?php if ($status->setting != 'unactive') : ?>
                                <div class="badge rounded-pill bg-success bg-gradient text-light m-1"><?= $status->status ?></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $task->getText() ?></p>
                <a href="/" class="btn btn-outline-primary">Вернуться на главную</a>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . '/footer.php'; ?>