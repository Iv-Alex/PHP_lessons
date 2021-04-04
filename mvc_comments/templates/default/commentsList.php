<article>
    <header class="article-header text-center pt-5 pb-4">
        <h4>Выводим комментарии</h4>
    </header>
    <div id="comments-list" class="row text-center" data-masonry='{"percentPosition": true }'>
        <?php foreach ($comments as $comment) : ?>
            <section class="col-md-6 col-lg-4" data-comment-id="<?= $comment->getId() ?>">
                <div class="wrap">
                    <div class="head"><?= $comment->getName() ?></div>
                    <div class="email"><?= $comment->getEmail() ?></div>
                    <div class="text text-break overflow-hidden"><?= $comment->getText() ?></div>
                </div>
            </section>
        <?php endforeach; ?>
    </div>
</article>
