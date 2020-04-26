<?php 
    session_start();

    if (!isset($_SESSION['usuario'])) {//testa se o indice usuário nao existe
		header('Location: index.php?erro=1'); 
	}

    require_once('db.class.php');

    $id_user = $_SESSION['id_usuario'];
    $seguir_id_usuario = $_POST['seguir_id_usuario'];

    if ($seguir_id_usuario == '' || $id_user == '') {
        die();
    }

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = "INSERT INTO usuarios_seguidores(id_usuario, seguindo_id_usuario) 
    VALUES($id_user, $seguir_id_usuario)";

    mysqli_query($link,$sql);

?>