<?php

require "../app_lista_tarefas/tarefa.model.php";
require "../app_lista_tarefas/tarefa.service.php";
require "../app_lista_tarefas/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if($acao == 'inserir') {
    if ($_POST['tarefa'] != '' && $_POST['descricao'] != '') {
        $tarefa = new Tarefa();
        $tarefa->setTarefa($_POST['tarefa']);
        $tarefa->setDescricao($_POST['descricao']);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao);
        $tarefaService->inserir($tarefa);

        header('Location: nova_tarefa.php?inclusao=1');
    } else { // Correção aqui
        header('Location: nova_tarefa.php?inclusao=0');
    }

} else if($acao == 'recuperar') {
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao);
    $tarefas = $tarefaService->recuperar();
}

if($acao == 'atualizar') {
    $id = $_POST['id']; // Supondo que você esteja passando o ID da tarefa a ser atualizada via POST
    $tarefa = new Tarefa();
    $tarefa->setId($id);
    $tarefa->setTarefa($_POST['titulo']);
    $tarefa->setDescricao($_POST['descricao']);
    
    $conexao = new Conexao();
    
    $tarefaService = new TarefaService($conexao);
    $tarefaService->atualizar($tarefa);
    
    // Redirecionar para a página desejada após a atualização
    header('Location: todas_tarefas.php?edit_status=0');
}

if($acao == 'remover') {
    $id = $_GET['id'];

    echo $id;

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao);
    $tarefaService->remover($id);

    header('Location: todas_tarefas.php?delete_status=0');

    // Não é necessário redirecionar para outra página aqui, 
    // pois normalmente isso é feito pelo JavaScript após receber a resposta do servidor.
}

if($acao == 'concluir') {
    $id = $_GET['id'];
    
    $conexao = new Conexao();
    
    $tarefaService = new TarefaService($conexao);
    $tarefaService->marcarComoRealizada($id);
    
    // Redirecionar para a página desejada após marcar como realizada
    header('Location: todas_tarefas.php?conclude_status=0');
}
