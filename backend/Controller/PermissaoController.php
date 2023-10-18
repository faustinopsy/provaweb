<?php

namespace App\Controller;

class PermissaoController {

    private $ips_permitidos;
    private $origesPermitidas;
    public function __construct() {
        $this->ips_permitidos = ['::1', '123.123.123.124'];
        $this->origesPermitidas= ['http://localhost:8082','http://192.168.56.1'];
        
    }
    public function autorizado(){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: * ');
        header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        $this->verOrigem();
        $this->verIP();
    }
    public function verOrigem(){
        if(!in_array($_SERVER['HTTP_ORIGIN'], $this->origesPermitidas)){
            echo json_encode(['error' => 'Acesso não autorizado origem'], 403);
            exit;
        }
    }
    public function verIP(){
        if (!in_array($_SERVER['REMOTE_ADDR'], $this->ips_permitidos)) {
            echo json_encode(['error' => 'Acesso não autorizado ip'], 403);
            exit;
        }
    }
}