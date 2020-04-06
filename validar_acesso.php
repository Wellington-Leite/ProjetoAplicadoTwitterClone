<?php 
	//o comando session sempre deve ser a primeira instrução, antes de qualquer entrada ou saida
	session_start();

	require_once('db.class.php');//Adicionando a classe de conexão com BD
	
	$user = $_POST['usuario'];
	$senha = $_POST['senha'];

	/*
	//degug
	echo $user;
	echo "<br>";
	echo $senha;*/

	$sql = "SELECT usuario, email FROM  usuarios WHERE usuario = '$user' AND senha = '$senha' ";

	$objDb = new db();
	$link = $objDb->conecta_mysql(); //link recebe o retorno da funçao conecta_mysql

	//Executar a consulta
	$resultado_id = mysqli_query($link, $sql); //atribuindo o resource do select

	//teste if relacionado com erros de sintax ou de instrução da consulta
	if ($resultado_id) {
		//recupera em formato de array o retorno da pesquisa ao banco
		$dados_usuario = mysqli_fetch_array($resultado_id); 
		
		if (isset($dados_usuario['usuario'])) {
			//o indice usuário passa a receber os dados do retorno a consulta do banco de dados contido no array
			$_SESSION['usuario'] = $dados_usuario['usuario'];
			$_SESSION['email'] = $dados_usuario['email'];

			header('Location: home.php');
		} else {
			header('Location: index.php?erro=1'); //redirecionar para pagina inicial indicado o erro
		}

	} else {
		echo "Erro na execução da consulta, favor entrar em contato com administrador do site";
	}

	

	/* Funcionamento basico das principais funcões de manipulação dos dados em BD
	  update return true/false
	  insert return true/false
	  select false/resource - referencia para o resultado da consulta
	  delete return true/false 
	*/

 ?>