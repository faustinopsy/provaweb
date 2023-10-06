<?php
namespace App\Test;
require "../vendor/autoload.php";

use App\Controller\UserController;
use App\Controller\ProdutoController;
use App\Model\Pessoa;
$users = new UserController();
$produtos = new ProdutoController();

$pessoa = new Pessoa();
echo $pessoa->create();

