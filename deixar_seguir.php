<?php 
    session_start();

    if (!isset($_SESSION['usuario'])) {//testa se o indice usuário nao existe
		header('Location: index.php?erro=1'); 
	}

    require_once('db.class.php');

    $id_user = $_SESSION['id_usuario'];
    $deixar_seguir_id_usuario = $_POST['deixar_seguir_id_usuario'];

    if ($deixar_seguir_id_usuario == '' || $id_user == '') {
        die();
    }

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = "DELETE FROM usuarios_seguidores WHERE id_usuario = $id_user AND seguindo_id_usuario = $deixar_seguir_id_usuario";

    //echo $sql;

    mysqli_query($link,$sql);

?>