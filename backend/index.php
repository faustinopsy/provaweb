<?php
namespace App\Test;
require "../vendor/autoload.php";

use App\Controller\UserController;
use App\Controller\ProdutoController;
use App\Model\Endereco;
use App\Model\Model;
use App\Model\Pessoa;
//$users = new UserController();
//$produtos = new ProdutoController();

$pessoa = new Pessoa();
$endereco = new Endereco();
// $db = new Model();
// //$db->insert("pessoa",['nome'=>'sid','email'=>'xxxxxx','datanascimento'=>'2023-05-12']);
// $db->delete("pessoa", ['id'=>1]);
