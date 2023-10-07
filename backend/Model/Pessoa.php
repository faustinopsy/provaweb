<?php
namespace App\Model;

use App\Model\Model;
use DateTime;
class Pessoa {
    private int $id;
    private string $nome;
    private string $email;
    private DateTime $dataNascimento;

    public $conn;

    public function __construct() {
        $this->conn = new Model();
        $this->conn->createTableFromModel($this);
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of dataNascimento
     */
    public function getDataNascimento(): DateTime
    {
        return $this->dataNascimento;
    }

    /**
     * Set the value of dataNascimento
     */
    public function setDataNascimento(DateTime $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }
}