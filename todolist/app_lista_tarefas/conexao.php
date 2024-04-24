<?php

class Conexao {
    private $host = 'localhost';
    private $dbname = 'todolist';
    private $user = 'root';
    private $pass = '';

    public function conectar() {
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->user,
                $this->pass
            );

            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage() . '</p>';
        }
    }
}
