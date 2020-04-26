<?php 
    session_start();

    if (!isset($_SESSION['usuario'])) {//testa se o indice usuário nao existe
		header('Location: index.php?erro=1'); 
	}

    require_once('db.class.php');

    $texto_tweet = $_POST['texto_tweet'];
    $id_user = $_SESSION['id_usuario'];

    if ($texto_tweet == '' || $id_user == '') {
        die();
    }

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = "INSERT INTO tweet(id_usuario, tweet) VALUES('$id_user', '$texto_tweet')";

    mysqli_query($link,$sql);

?>