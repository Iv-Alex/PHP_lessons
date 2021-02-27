<?php include __DIR__ . '\header.php'; ?>
<div class="container-fluid">
    <main>
        <h1>test</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Имя поль<wbr>зо<wbr>ва<wbr>теля</th>
                    <th scope="col">email</th>
                    <th scope="col">Текст задачи</th>
                    <th scope="col">Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <th scope="row"><?= $task['task_id'] ?></th>
                        <td><?= $task['name'] ?></td>
                        <td><?= $task['email'] ?></td>
                        <td><?= $task['text'] ?></td>
                        <td>&nbsp;</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
<?php include __DIR__ . '\footer.php'; ?>