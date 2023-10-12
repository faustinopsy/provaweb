<?php

namespace App\Controller;

use App\Model\Model;
use App\Endereco\Endereco;
class EnderecoController {
    private $db;
    private $endereco;
    public function __construct(Endereco $endereco) {
        $this->db = new Model();
        $this->endereco=$endereco;
    }

    public function insert(){
        
           if($this->db->insert('endereco', [
            'cep'=> $this->endereco->getCep(),
            'rua'=> $this->endereco->getRua(),
            'bairro'=> $this->endereco->getBairro(),
            'cidade'=> $this->endereco->getCidade(),
            'uf'=> $this->endereco->getUf(),
            'iduser'=> $this->endereco->getIduser(),
        ])){                                   

            return true;
        }
        return false;
    }
    public function select(){
        $user = $this->db->select('produtos');
        
        return  $user;
    }
    public function selectId($id){
        $user = $this->db->select('produtos',['id'=>$id]);
        
        return  $user;
    }
    public function update($newData,$conditions){
        if($this->db->update('produtos', $newData['nome'], $conditions['id'])){
            return true;
        }
        return false;
    }
    public function delete( $conditions){
        if($this->db->delete('produtos', $conditions['id'])){
            return true;
        }
        return false;
        
    }
}