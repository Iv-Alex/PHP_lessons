<?php include __DIR__ . '\header.php'; ?>
<div class="container-fluid">
    <main class="p-3">
        <div class="card">
            <div class="card-header">
                <div><?= $task['name'] ?></div>
                <div><?= $task['email'] ?></div>
            </div>
            <div class="card-body">
                <p class="card-text"><?= $task['text'] ?></p>
                <button class="btn btn-primary">Go somewhere</button>
            </div>
        </div>
    </main>
</div>
<?php include __DIR__ . '\footer.php'; ?>