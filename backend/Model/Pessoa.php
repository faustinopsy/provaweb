<?php
namespace App\Model;

use App\Model\Model;
use App\Model\ModelORM;
class Pessoa {
    private $id;
    private $nome;
    private $idade;
    private $email;
    public $conn;

    public function __construct() {
        $this->conn = new Model();
        $orm = new ModelORM($this->conn);
        $orm->createTableFromModel($this);
    }

    public function create() {
        $stmt = $this->conn->prepare("CALL InsertPessoas(:nome, :idade, :email)");
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    }

    public function update() {
        $stmt = $this->conn->prepare("CALL UpdatePessoas(:id, :nome, :idade, :email)");
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    }

    public function delete() {
        $stmt = $this->conn->prepare("CALL DeletePessoas(:id)");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Pessoas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->id = $result['id'];
            $this->nome = $result['nome'];
            $this->idade = $result['idade'];
            $this->email = $result['email'];
        }
    }

    // getters e setters para propriedades privadas...
}