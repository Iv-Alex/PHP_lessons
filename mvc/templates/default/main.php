<?php include __DIR__ . '\header.php'; ?>
<div class="container-fluid">
    <main>
        <div class="row">
            <h1>test</h1>
            <div class="text-end">
                <a href="/Tasks/new">Добавить задачу</a>
            </div>
        </div>
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
                        <th scope="row"><?= $task->getId() ?></th>
                        <td><?= $task->getName() ?></td>
                        <td><?= $task->getEmail() ?></td>
                        <td><?= $task->getText() ?></td>
                        <td>
                            <?php foreach ($task->getStatus() as $status) {
                                echo $status->caption . '<br>';
                            } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
<?php include __DIR__ . '\footer.php'; ?>