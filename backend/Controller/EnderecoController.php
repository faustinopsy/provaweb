<?php

namespace App\Controller;

use App\Model\Model;

class EnderecoController {

    private $db;
    private $endereco;

    public function __construct($endereco) {
        $this->db = new Model();
        $this->endereco =$endereco;
    }
    public function select(){
        $user = $this->db->select('endereco');
        
        return  $user;
    }
    public function insert($data){
        if($this->db->insert('endereco', $data)){
            return true;
        }
        return false;
    }
    public function update($newData,$conditions){
        if($this->db->update('endereco', $newData['rua'], $conditions['id'])){
            return true;
        }
        return false;
    }
    public function delete( $conditions){
        if($this->db->delete('endereco', $conditions['id'])){
            return true;
        }
        return false;
        
    }
}
