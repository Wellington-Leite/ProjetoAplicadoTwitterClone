<?php
	
	session_start();

	//Limpando as variáveis de sessão
	unset($_SESSION['usuario']);
	unset($_SESSION['email']);

	header('Location:index.php');

?>

