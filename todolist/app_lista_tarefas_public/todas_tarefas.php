<?php

$acao = 'recuperar';
require 'tarefa_controller.php';

?>

<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Todolist - All Tasks</title>

	<link rel="icon" href="./img/KWK.png" />

	<link
		href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&family=League+Spartan:wght@100..900&family=Outfit:wght@100..900&family=Reem+Kufi:wght@400..700&family=Varela&family=Ysabeau+SC:wght@1..1000&display=swap"
		rel="stylesheet" />

	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					screens: {
						'xs': '320px',
						'sm': '380px',
						'md': '768px',
						'lg': '1025px',
						'xl': '1280px',
						'2xl': '1536px'
					},
					fontFamily: {
						outfit: 'Outfit, sans-serif',
						league: 'League Spartan, sans-serif',
						reem: 'Reem Kufi, sans-serif',
						geologica: 'Geologica, sans-serif',
						ysabeau: 'Ysabeau S, sans-serif'
					}
				}
			}
		}
	</script>
	<script>
    
	let tarefaEditando = false;

    function editarTarefa(id, titulo, descricao, acao) {
		if (tarefaEditando) {
                return; // Impede a edição se uma tarefa já estiver sendo editada
            }

			tarefaEditando = true;

	if (acao === 'editar') {

    let form = document.createElement('form');
    form.action = 'tarefa_controller.php?acao=atualizar';
    form.method = 'post';
	form.classList = "flex flex-col justify-center items-center gap-y-3 w-full"
	
    let labelTitulo = document.createElement('label');
    
    let inputTitulo = document.createElement('input');
    inputTitulo.type = 'text';
    inputTitulo.name = 'titulo';
	inputTitulo.value = titulo;
    inputTitulo.textContent = titulo; // Preenche o campo de descrição com o valor atual
    inputTitulo.className = 'w-full border-2 border-zinc-950 bg-zinc-200 outline-none focus:border-zinc-500 xs:pl-2';
	
    let labelDescricao = document.createElement('label');
	labelDescricao.value = 'Vermelho'
	
    let inputDescricao = document.createElement('textarea');
    inputDescricao.name = 'descricao';
    inputDescricao.value = descricao;
    inputDescricao.className = 'w-full border-2 bg-zinc-200 border-zinc-950 outline-none focus:border-zinc-500 xs:pl-2 min-h-24';
    inputDescricao.textContent = descricao; // Preenche o campo de descrição com o valor atual

	let inputId = document.createElement('input');
	inputId.type = 'hidden';
	inputId.name = 'id';
	inputId.value = id;

    let button = document.createElement('button');
    button.type = 'submit';
    button.className = "bg-zinc-950 text-zinc-200 xs:min-w-[8em] md:min-w-[10em] md:py-[1%] xs:max-w-[12em] rounded-full font-semibold";
    button.innerHTML = "Atualizar";

    form.appendChild(inputTitulo);
    form.appendChild(inputDescricao);
	form.appendChild(inputId);
    form.appendChild(button);

    let tarefa = document.getElementById('tarefa_' + id);
    tarefa.innerHTML = ''; // Limpa o conteúdo da div antes de inserir o formulário
    tarefa.appendChild(form);

	let editButtons =document.querySelector('#editButtons');
	editButtons.classList = 'hidden'
	}

    if (acao === 'remover') {
        location.href = 'tarefa_controller.php?acao=remover&id=' + id;
    } else if (acao === 'concluir') {
        location.href = 'tarefa_controller.php?acao=concluir&id=' + id;
	}

	ocultarBotoesEdicao();
}

// Função para ocultar os botões de edição durante a edição
function ocultarBotoesEdicao() {
	let botoesEdicao = document.querySelectorAll('#editButtons');
    botoesEdicao.forEach(botao => {
        botao.style.display = 'none';
    });
}

        // Função para mostrar os botões de edição após a conclusão ou cancelamento da edição
        function mostrarBotoesEdicao() {
            let botoesEdicao = document.querySelectorAll('.editButtons');
    botoesEdicao.forEach(botao => {
        botao.style.display = 'flex'; // Ou 'block' dependendo do estilo CSS
    });
        }

        // Função para cancelar a edição de uma tarefa
        function cancelarEdicao() {
            tarefaEditando = false; // Redefine a variável para indicar que nenhuma tarefa está sendo editada
            mostrarBotoesEdicao(); // Mostra novamente os botões de edição
            // Restante do código para reverter as alterações de interface, se necessário...
        }
	
</script>
</head>

<body
	class="bg-zinc-200 flex font-outfit flex-col justify-center items-center landscape:h-auto h-dvh px-[10%] lg:px-[15%] 2xl:px-[25%]">

	<nav class="bg-zinc-200 border-b border-zinc-300 shadow-lg absolute top-0 w-full px-4 py-2">
		<a class="flex items-center w-full gap-x-1 font-bold md:text-xl" href="#">
			<img src="img/logo.png" class="w-8 md:w-10 object-contain" alt="logo">
			Todolist
		</a>
	</nav>

	<?php if(isset($_GET['delete_status']) && $_GET['delete_status'] == 0): ?>
    <section class="w-full h-full bg-black/40 fixed top-0 z-50 backdrop-blur-sm flex justify-center items-center">
        <div class="h-[40%] lg:w-[50%] 2xl:w-[40%] flex-col w-[70%] text-zinc-200 bg-red-600 flex gap-y-3 justify-center items-center shadow-2xl rounded-xl text-center font-medium text-xl 2xl:text-2xl">
            <h1>A Tarefa foi<br><span class="text-4xl 2xl:text-5xl font-bold">Exluida!</span></h1>
            <a href="todas_tarefas.php">
                <button class="bg-zinc-950 px-6 py-[1.5%] rounded-full">
                    Finalizar
                </button>
            </a>
        </div>
    </section>
	<?php elseif(isset($_GET['edit_status']) && $_GET['edit_status'] == 0): ?>
	<section class="w-full h-full bg-black/40 fixed top-0 z-50 backdrop-blur-sm flex justify-center items-center">
        <div class="h-[40%] lg:w-[50%] 2xl:w-[40%] flex-col w-[70%] text-zinc-200 bg-sky-600 flex gap-y-3 justify-center items-center shadow-2xl rounded-xl text-center font-medium text-xl 2xl:text-2xl">
            <h1>A Tarefa foi<br><span class="text-4xl 2xl:text-5xl font-bold">Editada!</span></h1>
            <a href="todas_tarefas.php">
                <button class="bg-zinc-950 px-6 py-[1.5%] rounded-full">
                    Finalizar
                </button>
            </a>
        </div>
    </section>
	<?php elseif(isset($_GET['conclude_status']) && $_GET['conclude_status'] == 0): ?>
		<section class="w-full h-full bg-black/40 fixed top-0 z-50 backdrop-blur-sm flex justify-center items-center">
        <div class="h-[40%] lg:w-[50%] 2xl:w-[40%] flex-col w-[70%] text-zinc-200 bg-green-600 flex gap-y-3 justify-center items-center shadow-2xl rounded-xl text-center font-medium text-xl 2xl:text-2xl">
            <h1>A Tarefa foi<br><span class="text-4xl 2xl:text-5xl font-bold">Concluida!</span></h1>
            <a href="todas_tarefas.php">
                <button class="bg-zinc-950 px-6 py-[1.5%] rounded-full">
                    Finalizar
                </button>
            </a>
        </div>
    </section>
	<?php endif; ?>

	<main
		class="w-full xs:pt-[4.5em] landscape:pt-[5.5em] lg:landscape:pt-[10em] lg:landscape:pt-[7em] xs:pb-[2em] lg:landscape:pb-[4em] 2xl:landscape:pt-[8em]">

		<ul class="flex flex-col gap-y-4 text-md md:text-lg lg:text-xl 2xl:text-2xl text-zinc-200 text-white text-center">
			<a href="index.php">
				<li class="bg-zinc-950 p-4 rounded-xl shadow-lg hover:text-zinc-300/80">Tarefas
					pendentes</li>
			</a>
			<a href="nova_tarefa.php">
				<li class="bg-zinc-950 p-4 rounded-xl shadow-lg hover:text-zinc-300/80">Nova tarefa</li>
			</a>
			<a href="todas_tarefas.php">
				<li class="bg-zinc-950 p-4 rounded-xl shadow-lg hover:text-zinc-300/80">Todas tarefas</li>
			</a>
		</ul>

		<div class="bg-zinc-950 mt-10 rounded-xl px-[5%] overflow-y-scroll max-h-80 md:max-h-[30em] lg:max-h-max lg:overflow-auto">
			<div class="flex flex-col text-zinc-200 gap-y-5 xs:py-4 sm:py-8 md:text-lg 2xl:text-xl">

			<h1 class="text-center uppercase tracking-widest">Todas as Tarefas</h1>

			<?php foreach($tarefas as $tarefa): ?>
    <div class="bg-zinc-200 flex px-3 py-4 rounded-md justify-between">
        <div class="flex flex-col w-full justify-center text-zinc-950 pr-0 lg:mr-3" id="tarefa_<?= $tarefa['id_tarefa'] ?>">
			<h1 class="font-bold text-lg 2xl:text-xl"><?= $tarefa['tarefa'] ?></h1>
			<h1 class="font-bold text-xs 2xl:text-sm"><?= '(' . ($tarefa['status']) . ')' ?></h1>
			<p><?= $tarefa['descricao'] ?></p>
			<p class="text-xs font-bold"><?= str_replace('-', '/' ,substr($tarefa['data_cadastrado'], 0, 10)) ?></p>
		</div>

        <div class="flex lg:gap-x-1 flex-col gap-y-1 lg:gap-y-0 lg:flex-row" id="editButtons">
            <button onclick="editarTarefa(<?= $tarefa['id_tarefa'] ?>, '', '', 'concluir')">
                <img class="w-[1.45em] object-contain" src="../app_lista_tarefas_public/img/correct.png" alt="">
            </button>
            <button onclick="editarTarefa(<?= $tarefa['id_tarefa'] ?>, '<?= $tarefa['tarefa'] ?>', '<?= $tarefa['descricao'] ?>', 'editar')">
                <img class="w-8 object-contain" src="../app_lista_tarefas_public/img/edit.png" alt="">
            </button>
            <button onclick="editarTarefa(<?= $tarefa['id_tarefa'] ?>, '', '', 'remover')">
				<img class="w-8 object-contain" src="../app_lista_tarefas_public/img/delete.png" alt="">
			</button>
        </div>
    </div>
<?php endforeach; ?>

			</div>
		</div>
	</main>
</body>

</html>