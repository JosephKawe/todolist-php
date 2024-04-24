<?php

//CRUD
class TarefaService {

    private $conexao;

    public function __construct(Conexao $conexao) {
        $this->conexao = $conexao;
    }

    public function inserir(Tarefa $tarefa) {
        try {
            $query = 'INSERT INTO tb_tarefas (tarefa, descricao) VALUES (:tarefa, :descricao)';
            $stmt = $this->conexao->conectar()->prepare($query);
            $stmt->bindValue(':tarefa', $tarefa->getTarefa());
            $stmt->bindValue(':descricao', $tarefa->getDescricao());
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratar o erro de alguma forma adequada
            echo "Erro ao inserir tarefa: " . $e->getMessage();
        }
    }

    public function recuperar() {
        try {
            $query = 'SELECT t.id AS id_tarefa, t.tarefa, t.descricao, t.data_cadastrado, s.id AS id_status, s.status FROM tb_tarefas AS t LEFT JOIN tb_status AS s ON t.id_status = s.id';
            $stmt = $this->conexao->conectar()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratar o erro de alguma forma adequada
            echo "Erro ao recuperar tarefas: " . $e->getMessage();
        }
    }
    

    public function atualizar(Tarefa $tarefa) {
        try {
            $query = 'UPDATE tb_tarefas SET tarefa = :tarefa, descricao = :descricao WHERE id = :id';
            $stmt = $this->conexao->conectar()->prepare($query);
            $stmt->bindValue(':id', $tarefa->getId());
            $stmt->bindValue(':tarefa', $tarefa->getTarefa());
            $stmt->bindValue(':descricao', $tarefa->getDescricao());
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratar o erro de alguma forma adequada
            echo "Erro ao atualizar tarefa: " . $e->getMessage();
        }
    }

    public function remover($id) {
        try {
            $query = 'DELETE FROM tb_tarefas WHERE id = :id';
            $stmt = $this->conexao->conectar()->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratar o erro de alguma forma adequada
            echo "Erro ao remover tarefa: " . $e->getMessage();
        }
    }

    public function marcarComoRealizada($id) {
        try {
            $query = 'UPDATE tb_tarefas SET id_status = :id_status WHERE id = :id';
            $stmt = $this->conexao->conectar()->prepare($query);
            $id_status_realizada = 2; // Este valor pode estar incorreto, dependendo da sua tabela tb_status
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':id_status', $id_status_realizada);
            $stmt->execute();
        } catch (PDOException $e) {
            // Tratar o erro de alguma forma adequada
            echo "Erro ao marcar tarefa como realizada: " . $e->getMessage();
        }
    }    
    
}

