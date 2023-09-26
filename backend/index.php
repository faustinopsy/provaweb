<?php
namespace App\Test;
require "../vendor/autoload.php";

use App\Test\UserTest;
use App\Test\ProdutoTest;

$users = new UserTest();
$produtos = new ProdutoTest();

$users->runTests();
echo "<hr><br>PRODUTOS<br><hr>";
$produtos->runTests();