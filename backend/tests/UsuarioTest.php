<?php

use App\Usuario\Usuario;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    protected $usuario;
    protected function setUp(): void
    {
        $this->usuario = new Usuario();
    }
    public function testSetAndGetId()
    {
        $id = 1;
        $this->usuario->setId($id);
        $this->assertEquals(1, $this->usuario->getId());
    }

    public function testSetAndGetNome()
    {
        $nome = "Test User";
        $this->usuario->setNome($nome);
        $this->assertEquals($nome, $this->usuario->getNome());
    }

    public function testSetAndGetEmail()
    {
        $email = "test@example.com";
        $this->usuario->setEmail($email);
        $this->assertEquals($email, $this->usuario->getEmail());
    }

    public function testSetAndGetSenha()
    {
        $senha = "Test1234";
        $this->usuario->setSenha($senha);
        $this->assertEquals(password_verify($senha,$this->usuario->getSenha()), $this->usuario->getSenha());
    }
}