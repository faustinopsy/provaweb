<?php

namespace App\Test;

use App\Model\Model;

class ProdutoTest {

    private $db;

    public function __construct() {
        $this->db = new Model();
    }

    public function runTests() {
        echo "CRUD tests...\n";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $produto = $this->db->select('produtos');
        echo "Test do Select " . count($produto)  . " produtos.\n";
        foreach($produto as $produtos){
            foreach($produtos as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
        // INSERT
        echo "<b>INSERÇÃO:</b>";
        $data = ['nome' => 'Café', 'preco' => '1,50', 'quantidade' => '5'];
        $result = $this->db->insert('produtos', $data);
        echo "Teste do Insert: " . ($result ? "Sucesso" : "Falha") . "\n";
        echo "<hr>";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $produto = $this->db->select('produtos');
        echo "Test do Select " . count($produto)  . " produtos.\n";
        foreach($produto as $produtos){
            foreach($produtos as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
        // UPDATE
        echo "<b>ATUALIZAÇÃO:</b>";
        $newData = ['nome' => 'Café', 'preco' => '3,50', 'quantidade' => '2'];
        $conditions = ['nome' => 'Café'];
        $result = $this->db->update('produtos', $newData, $conditions);
        echo "Update : " . ($result ? "Sucesso" : "Falha") . "\n";
        echo "<hr>";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $produto = $this->db->select('produtos');
        echo "Test do Select " . count($produto)  . " produtos.\n";
        foreach($produto as $produtos){
            foreach($produtos as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
        // DELETE
        echo "<b>EXCLUSÃO:</b>";
        $conditions = ['nome' => 'Café'];
        $result = $this->db->delete('produtos', $conditions);
        echo "Delete : " . ($result ? "Sucesso" : "Falha") . "\n";
        echo "<hr>";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $produto = $this->db->select('produtos');
        echo "Test do Select " . count($produto)  . " produtos.\n";
        foreach($produto as $produtos){
            foreach($produtos as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
    }
}
