<?php

namespace App\produtos;
require "../vendor/autoload.php";

use App\Controller\ProdutoController;

$prod = new ProdutoController();

$body = json_decode(file_get_contents('php://input'), true);
$id=isset($_GET['id'])?$_GET['id']:'';
switch($_SERVER["REQUEST_METHOD"]){
    case "POST";
        $resultado = $prod->insert($body);
        echo json_encode(['status'=>$resultado]);
    break;
    case "GET";
        if(!isset($_GET['id'])){
            $resultado = $prod->select();
            echo json_encode(["produtos"=>$resultado]);
        }else{
            $resultado = $prod->selectId($id);
            echo json_encode(["status"=>true,"produtos"=>$resultado[0]]);
        }
       
    break;
    case "PUT";
        $resultado = $prod->update($body,intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;
    case "DELETE";
        $resultado = $prod->delete(intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;  
}