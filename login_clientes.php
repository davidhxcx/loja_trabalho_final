<?php
	// inicia a seção (SESSION) para ler ou gravar dados
	session_start();

	// importa o código dos scripts
	require_once 'lib/constantes.php';
	require_once 'lib/database.php';
	require_once 'lib/funcoes.php';

	// se uma ação foi informada na URL
	if (isset($_GET['acao']))
	{
		// captura a ação informada do array superglobal $_GET[]
		$acao = $_GET['acao'];
	}

	// se não foi informada ação
	if(!isset($acao))
	{
		// assume ação padrão (identificar)
		$acao = 'identificar';
	}

	switch($acao) {
		case 'identificar':

			require_once('gui/form_login.php');

			break;
		case 'autenticar':
			$email = $_POST['email'];
			$senha = $_POST['senha_clientes'];

			$consulta = "
				select * from clientes where email = '$email'
			";

			consultar($consulta);

			$usuario = proximo_registro();

			if ($usuario) {
				if($senha == $usuario['senha']) {
					$_SESSION['id_clientes'] = $usuario['id'];
					$_SESSION['nome_clientes'] = $usuario['nome'];
					$_SESSION['email_clientes'] = $usuario['email'];

					redireciona($_SESSION['request_uri']);
				}
				else {
					die('A senha informanda não confere.');
				}
			}
			else {
				die('O login informado não foi encontrado.');
			}

			break;
		case 'sair':
			session_destroy();

			redireciona(URL_BASE);

			break;
		default:
			// encerra (mata) o script exibindo mensagem de erro
			die('Erro: Ação inexistente!');
	}