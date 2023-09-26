<?php

namespace App\Test;

use App\Model\Model;

class UserTest {

    private $db;

    public function __construct() {
        $this->db = new Model();
    }

    public function runTests() {
        echo "CRUD tests...\n";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $user = $this->db->select('users');
        echo "Test do Select " . count($user)  . " users.\n";
        foreach($user as $users){
            foreach($users as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
        // INSERT
        echo "<b>INSERÇÃO:</b>";
        $data = ['nome' => 'testUser', 'email' => 'testPass@xxx.com', 'senha' => '123456'];
        $result = $this->db->insert('users', $data);
        echo "Teste do Insert: " . ($result ? "Sucesso" : "Falha") . "\n";
        echo "<hr>";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $user = $this->db->select('users');
        echo "Test do Select " . count($user)  . " users.\n";
        foreach($user as $users){
            foreach($users as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
        // UPDATE
        echo "<b>ATUALIZAÇÃO:</b>";
        $newData = ['nome' => 'updatedUser'];
        $conditions = ['nome' => 'testUser'];
        $result = $this->db->update('users', $newData, $conditions);
        echo "Update : " . ($result ? "Sucesso" : "Falha") . "\n";
        echo "<hr>";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $user = $this->db->select('users');
        echo "Test do Select " . count($user)  . " users.\n";
        foreach($user as $users){
            foreach($users as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
        // DELETE
        echo "<b>EXCLUSÃO:</b>";
        $conditions = ['nome' => 'updatedUser'];
        $result = $this->db->delete('users', $conditions);
        echo "Delete : " . ($result ? "Sucesso" : "Falha") . "\n";
        echo "<hr>";
        // SELECT
        echo "<b>SELEÇÃO:</b>";
        $user = $this->db->select('users');
        echo "Test do Select " . count($user)  . " users.\n";
        foreach($user as $users){
            foreach($users as $key => $value){
                echo '<br>'.$key.': '.$value;
            }
        }
        echo "<hr>";
    }
}
