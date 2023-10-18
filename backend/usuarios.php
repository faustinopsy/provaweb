<?php

namespace App\usuarios;
require "../vendor/autoload.php";

use App\Controller\UserController;

$users = new UserController();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: * ');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Cache-Control: no-cache, no-store, must-revalidate');
        $ips_permitidos = ['::1', '123.123.123.124'];
        $origesPermitidas = ['http://localhost:8082','http://192.168.56.1'];
        if (!in_array($_SERVER['REMOTE_ADDR'], $ips_permitidos)) {
            echo json_encode(['error' => 'Acesso não autorizado ip'], 403);
            exit;
        }elseif(!in_array($_SERVER['HTTP_ORIGIN'], $origesPermitidas)){
            echo json_encode(['error' => 'Acesso não autorizado origem'], 403);
            exit;
        }
$body = json_decode(file_get_contents('php://input'), true);
$id=isset($_GET['id'])?$_GET['id']:'';
switch($_SERVER["REQUEST_METHOD"]){
    case "POST";
        $resultado = $users->insert($body);
        echo json_encode(['status'=>$resultado]);
    break;
    case "GET";
        if(!isset($_GET['id'])){
            $resultado = $users->select();
            if(!is_array($resultado)){
                echo json_encode(["status"=>false]);
                exit;
            }
            echo json_encode(["status"=>true,"usuarios"=>$resultado]);
        }else{
            $resultado = $users->selectId($id);
            echo json_encode(["status"=>true,"usuario"=>$resultado[0]]);
        }
       
    break;
    case "PUT";
        $resultado = $users->update($body,intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;
    case "DELETE";
        $resultado = $users->delete(intval($_GET['id']));
        echo json_encode(['status'=>$resultado]);
    break;  
}