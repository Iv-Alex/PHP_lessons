<?php

namespace Ivalex\Controllers;

class MainController
{
    public function main()
    {
        echo 'Main page';
    }

    public function sayHello(string $name)
    {
        echo 'Привет, ' . $name;
    }
}
