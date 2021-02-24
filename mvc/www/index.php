<?php

error_reporting(E_ALL);

spl_autoload_register(function (string $className) {
    var_dump($className);
    require_once __DIR__ .  '/../src/' . str_replace('\\', '/', $className) . '.php';
});

$author = new \Ivalex\Models\Users\User('Ivan');
$article = new \Ivalex\Models\Articles\Article('Good night', 'Go to sleep', $author);

echo "Автор статьи {$article->getTitle()} - {$article->getAuthor()->getName()}";
