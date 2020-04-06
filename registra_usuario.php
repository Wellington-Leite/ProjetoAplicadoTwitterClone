<?php 

	require_once('db.class.php');
	//Super global post e get são como arrays associativos
	$user = $_POST['usuario'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$objDb = new db();
	$link = $objDb->conecta_mysql(); //link recebe o retorno da funçao conecta_mysql

	//utilizando aspas duplas primeiro verifica-se se tem variavel e pega o valor dela,
	//ou seja nao é necessário concatenar
	$sql = "insert into usuarios (usuario, email, senha) values ('$user', '$email', '$senha') ";

	//executar a query, funcão usa como parametro o link de conexão e a query
	//a funçao mysqli_query retorna false se houver algun erro
	if (mysqli_query($link, $sql)) {
		echo "Cadastro efetuado com sucesso!";
	}else {
		echo "Erro ao registrar usuário!";
	}

 ?>