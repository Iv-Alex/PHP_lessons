<?php include __DIR__ . '/header.php'; ?>
<main>
    <div class="row p-1">
        <div class="text-end m-1">
            <a class="btn btn-outline-primary" href="/Tasks/add">Добавить задачу</a>
        </div>
    </div>
    <table class="table table-primary table-striped">
        <thead>
            <tr>
                <?php foreach ($tableHeaders as $th) : ?>
                    <th scope="col">
                        <div class="d-flex justify-content-between align-items-center" title="<?= $th['title'] ?>">
                            <span class="p-1"><?= $th['caption'] ?></span>
                            <a href="<?= $th['sortHref'] ?>"><i class="fas <?= $th['sortIconStyle'] ?> text-right"></i></a>
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
                        <?php foreach ($task->getStatus() as $status) {
                            echo $status->status . '<br>';
                        } ?>
                        <?php if (!empty($user) && ($user->getRole() == 'admin')) : ?>
                            <a class="btn-link" href="/tasks/<?= $task->getId() ?>/edit">Изменить</a>
                        <?php endif; ?>
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
                            <a class="page-link" href="/page/<?= $pageIndex ?>/<?= $sortColumnNumber ?>/<?= $sortDesc ?>"><?= $pageIndex ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/footer.php'; ?>