<?php

class Tarefa {
    private $id;
    private $id_status;
    private $tarefa;
    private $descricao;
    private $data_cadastro;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdStatus() {
        return $this->id_status;
    }

    public function setIdStatus($id_status) {
        $this->id_status = $id_status;
    }

    public function getTarefa() {
        return $this->tarefa;
    }

    public function setTarefa($tarefa) {
        $this->tarefa = $tarefa;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDataCadastro() {
        return $this->data_cadastro;
    }

    public function setDataCadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }
}
