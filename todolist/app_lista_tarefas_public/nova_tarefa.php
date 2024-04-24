<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Todolist = new Task</title>

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
</head>

<body
	class="bg-zinc-200 flex font-outfit flex-col justify-center items-center landscape:h-auto h-dvh px-[10%] lg:px-[15%] 2xl:px-[25%]">
	<nav class="bg-zinc-200 border-b border-zinc-300 shadow-lg absolute top-0 w-full px-4 py-2">
		<a class="flex items-center w-full gap-x-1 font-bold md:text-xl" href="#">
			<img src="img/logo.png" class="w-8 md:w-10 object-contain" alt="logo">
			Todolist
		</a>
	</nav>

	<?php if(isset($_GET['inclusao']) && $_GET['inclusao'] == 1): ?>
    <section class="w-full h-full bg-black/40 fixed top-0 z-50 backdrop-blur-sm flex justify-center items-center">
        <div class="h-[40%] lg:w-[50%] 2xl:w-[40%] flex-col w-[70%] text-zinc-200 bg-green-600 flex gap-y-3 justify-center items-center shadow-2xl rounded-xl text-center font-medium text-xl 2xl:text-2xl">
            <h1>Tarefa Adicionada com<br><span class="text-4xl 2xl:text-5xl font-bold">Sucesso!</span></h1>
            <a href="nova_tarefa.php">
                <button class="bg-zinc-950 px-6 py-[1.5%] rounded-full">
                    Finalizar
                </button>
            </a>
        </div>
    </section>
<?php elseif(isset($_GET['inclusao']) && $_GET['inclusao'] == 0): ?>
    <section class="w-full h-full bg-black/40 fixed top-0 z-50 backdrop-blur-sm flex justify-center items-center">
        <div class="h-[40%] lg:w-[50%] 2xl:w-[40%] flex-col w-[70%] text-zinc-200 bg-red-600 flex gap-y-3 justify-center items-center shadow-2xl rounded-xl text-center font-medium text-xl 2xl:text-2xl px-5">
            <div>
			<h1>A Tarefa não foi<br><span class="text-4xl 2xl:text-5xl font-bold">Adicionada!</span></h1>
			<p>Os campos não podem estar vazios.</p>
			</div>
            <a href="nova_tarefa.php">
                <button class="bg-zinc-950 px-6 py-[1.5%] rounded-full">
                    Finalizar
                </button>
            </a>
        </div>
    </section>
<?php endif; ?>


	<main
		class="w-full xs:pt-[4.5em] landscape:pt-[5.5em] lg:landscape:pt-[10em] lg:landscape:pt-[7em] xs:pb-[2em] lg:landscape:pb-[4em] 2xl:landscape:pt-[8em]">
		<ul class="flex flex-col gap-y-4 text-md md:text-lg lg:text-xl 2xl:text-2xl text-white text-center">
			<a href="index.php">
				<li class="bg-zinc-950 p-4 rounded-xl shadow-lg active:text-pink-300">Tarefas
					pendentes</li>
			</a>
			<a href="nova_tarefa.php">
				<li class="bg-zinc-950 p-4 rounded-xl shadow-lg ">Nova tarefa</li>
			</a>
			<a href="todas_tarefas.php">
				<li class="bg-zinc-950 p-4 rounded-xl shadow-lg ">Todas tarefas</li>
			</a>
		</ul>

		<div
			class="bg-zinc-950 mt-10 rounded-xl px-[5%] overflow-y-scroll max-h-80 md:max-h-[30em] lg:max-h-max lg:overflow-auto">
			<div class="flex flex-col text-zinc-200 gap-y-5 xs:py-4 sm:py-8 md:text-lg 2xl:text-xl">

			<h1 class="text-center uppercase tracking-widest">Nova Tarefa</h1>
				
				<form method="post" action="tarefa_controller.php?acao=inserir" class="relative mb-3 flex flex-col justify-center gap-y-3 lg:gap-y-6 items-center">
					<input type="text" name="tarefa" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[twe-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0 border-2"
					id="novaTarefa"/>
					<label for="descricao"
					class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.2rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[twe-input-state-active]:-translate-y-[0.9rem] peer-data-[twe-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary peer-focus:bg-zinc-950 peer-focus:px-1 peer-focus:text-zinc-200">Titulo
					</label>
					<input type="text" name="descricao" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[twe-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-white dark:placeholder:text-neutral-300 dark:autofill:shadow-autofill dark:peer-focus:text-primary [&:not([data-twe-input-placeholder-active])]:placeholder:opacity-0 border-2"
					id="descricao"/>
					<label for="descricao"
					class="pointer-events-none absolute left-3 top-[3.4em] mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[1.6] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[0.9rem] peer-focus:scale-[0.8] peer-focus:text-primary peer-data-[twe-input-state-active]:-translate-y-[0.9rem] peer-data-[twe-input-state-active]:scale-[0.8] motion-reduce:transition-none dark:text-neutral-400 dark:peer-focus:text-primary peer-focus:bg-zinc-950 peer-focus:px-1 peer-focus:text-zinc-200">Descricao
					</label>
					

				<button
					class="bg-zinc-200 text-zinc-950 xs:min-w-[8em] md:min-w-[10em] md:py-[1%] xs:max-w-[12em] rounded-full font-semibold">Cadastrar</button>
			</form>
		</div>
	</div>
</div>
</div>
</main>
</body>

</html>

<style>
	input:not(:placeholder-shown) + label {
    transform: translateY(-0.9rem) scale(0.8);
    pointer-events: none;
    color: #e4e4e7;
	background-color: #09090b;
	padding-left: 0.25rem;
padding-right: 0.25rem;
}

/* Estilos para o rótulo quando o campo de entrada estiver em foco */
input:focus + label {
    transform: translateY(-0.9rem) scale(0.8);
    color: #707B81;
}
</style>