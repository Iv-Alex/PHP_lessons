<?php include __DIR__ . '/header.php'; ?>
<?php
$fields = [
    ['id', '#', 'id задачи'],
    ['name', 'Имя', "Имя пользователя"],
    ['email', 'email', 'Адрес электронной почты'],
    ['text', 'Текст задачи', 'Текст задачи'],
    ['status', 'Статус', 'Статус задачи'],
]
?>
<main>
    <div class="row p-1">
        <div class="text-end m-1">
            <a class="btn btn-outline-primary" href="/Tasks/add">Добавить задачу</a>
        </div>
    </div>
    <table class="table table-primary table-striped">
        <thead>
            <tr>
                <?php
                foreach ($fields as $field) :
                    $columnNumber = array_search($field[0], $indexedFields, true);
                    $href = '/page/0/' . $columnNumber . '/';
                    if ($columnNumber == $sortColumnNumber) {
                        if ($sortDesc) {
                            $href .= '0';
                            $style = 'fa-sort-down';
                        } else {
                            $href .= '1';
                            $style = 'fa-sort-up';
                        }
                    } else {
                        $href .= '0';
                        $style = 'fa-sort';
                    }
                ?>
                    <th scope="col">
                        <div class="d-flex justify-content-between align-items-center" title="<?= $field[2] ?>">
                            <span class="p-1"><?= $field[1] ?></span>
                            <a href="<?= $href ?>"><i class="fas <?= $style ?> text-right"></i></a>
                        </div>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <th scope="row">#<?= $task->getId() ?></th>
                    <td><?= $task->getName() ?></td>
                    <td><?= $task->getEmail() ?></td>
                    <td><?= $task->getText() ?></td>
                    <td>
                        <?php if (!empty($user) && ($user->getRole() == 'admin')) : ?>
                            <a class="btn btn-outline-primary" href="/task/<?= $task->getId() ?>/edit">Редактировать задачу</a>
                        <?php endif; ?>
                        <?php foreach ($task->getStatus() as $status) {
                            echo $status->status . '<br>';
                        } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if ($showPageNav) : ?>
        <nav aria-label="Task page navigation">
            <ul class="pagination pagination-sm justify-content-center">
                <?php for ($pageIndex = 1; $pageIndex <= $cPage; $pageIndex++) : ?>
                    <?php if ($pageIndex == $activePage) : ?>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link"><?= $pageIndex ?></span>
                        </li>
                    <?php else : ?>
                        <li class="page-item">
                            <a class="page-link" href="/page/<?= $pageIndex ?>"><?= $pageIndex ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/footer.php'; ?>