<?php 

	require_once('db.class.php');
	//Super global post e get são como arrays associativos
	$user = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = md5($_POST['senha']);

	$objDb = new db();
	$link = $objDb->conecta_mysql(); //link recebe o retorno da funçao conecta_mysql

	$user_existe = false;
	$email_existe = false;

	//Verificar se o usuario ja existe
	$sql = "select * from usuarios where usuario = '$user'";
	if ($resultado_id = mysqli_query($link,$sql)) {
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if (isset($dados_usuario['usuario'])) {
			$user_existe = true;
		}
	} else {
		echo "Erro ao tentar localizar registro de E-mail";
	}

	//Verificar se o e-mail ja existe
	$sql = "select * from usuarios where email = '$email'";
	if ($resultado_id = mysqli_query($link,$sql)) {
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if (isset($dados_usuario['email'])) {
			$email_existe = true;
		}
	} else {
		echo "Erro ao tentar localizar registro de user";
	}

	if ($user_existe || $email_existe) {
		$retorno_get = '';

		if ($user_existe) {
			$retorno_get.="erro_user=1&";
		}
		if ($email_existe) {
			$retorno_get.="erro_email=1&";
		}

		header('Location: inscrevase.php?'.$retorno_get);
		die();//interrompe a execução do script
	}
	/* Utilizando aspas duplas primeiro verifica-se se tem variavel entre aspas simples e pega o valor contido,
		ou seja nao é necessário concatenar
	*/
	$sql = "insert into usuarios (usuario, email, senha) values ('$user', '$email', '$senha') ";

	//executar a query, funcão usa como parametro o link de conexão e a query
	//a funçao mysqli_query retorna false se houver algun erro
	if (mysqli_query($link, $sql)) {
		echo "Cadastro efetuado com sucesso!";
	}else {
		echo "Erro ao registrar usuário!";
	}

 ?>