<?php include __DIR__ . '/../header.php'; ?>
<main>
    <h1>test</h1>
    <?php foreach ($tasks as $task) : ?>
        <h2><?= $task['title'] ?></h2>
        <p><?= $task['text'] ?></p>
        <hr>
    <?php endforeach; ?>
</main>
<?php include __DIR__ . '/../footer.php'; ?>