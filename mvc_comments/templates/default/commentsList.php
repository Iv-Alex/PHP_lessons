


<?php foreach ($comments as $comment) : ?>
    <h4><?= $comment->getName() ?></h4>
    <h5><?= $comment->getEmail() ?></h5>
    <p><?= $comment->getText() ?></p>
<?php endforeach; ?>


