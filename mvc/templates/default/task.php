<?php include __DIR__ . '/header.php'; ?>
<div class="container-fluid">
    <main class="p-3">
        <div class="card">
            <div class="card-header">
                <div class="row--------------------------------------------">
                    <div>
                        <div><?= $task->getName() ?></div>
                        <div><?= $task->getEmail() ?></div>
                    </div>
                    <div>
                        <?php foreach ($task->getStatus() as $status) : ?>
                            <div><?= $status->status ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $task->getText() ?></p>
                <a href="/" class="btn btn-primary">Вернуться на главную</a>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . '/footer.php'; ?>