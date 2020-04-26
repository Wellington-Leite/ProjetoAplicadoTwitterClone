<?php 
    session_start();

    if (!isset($_SESSION['usuario'])) {//se o user não existir
		header('Location: index.php?erro=1'); 
	}

    require_once('db.class.php');

    $id_user = $_SESSION['id_usuario'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS dt_include_format, t.tweet, u.usuario 
    FROM tweet AS t JOIN usuarios AS u ON (t.id_usuario = u.id) 
    WHERE id_usuario = $id_user 
    OR id_usuario IN (SELECT seguindo_id_usuario FROM usuarios_seguidores WHERE id_usuario = $id_user)
    ORDER BY data_inclusao DESC ";

    $resultado_id = mysqli_query($link,$sql);

    if ($resultado_id) {
        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            echo '<a href="#" class="list-group-item">';
                echo '<h4 class="list-group-heading"> '.$registro['usuario'].' <small> - '.$registro['dt_include_format'].'</small></h4>';
                echo '<p class="list-group-item-text">'.$registro['tweet'].'</p>';
            echo '</a>';
        }
    } else {
        echo 'Erro ao consultas os tweets';
    }
?>