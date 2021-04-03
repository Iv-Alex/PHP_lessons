<article>
    <header class="article-header text-center py-5">
        <h4>Выводим комментарии</h4>
    </header>
    <div id="comments-list" class="row text-center">
        <?php foreach ($comments as $comment) : ?>
            <section class="col-sm-4" data-comment-id="<?= $comment->getId() ?>">
                <div class="head"><?= $comment->getName() ?></div>
                <div class="email"><?= $comment->getEmail() ?></div>
                <div class="text"><?= $comment->getText() ?></div>
            </section>
        <?php endforeach; ?>
    </div>
</article>