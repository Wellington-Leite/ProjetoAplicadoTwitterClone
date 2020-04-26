<?php 
    session_start();

    if (!isset($_SESSION['usuario'])) {//se o user não existir
		header('Location: index.php?erro=1'); 
	}

    require_once('db.class.php');
    
    $name_people = $_POST['name_people'];    
    $id_user = $_SESSION['id_usuario'];

    $objDb = new db();
    $link = $objDb->conecta_mysql();
    

    $sql = "SELECT u.id, u.usuario, u.email, us.*
    FROM usuarios As u 
    LEFT JOIN usuarios_seguidores AS us 
    ON (us.id_usuario = $id_user AND u.id = us.seguindo_id_usuario)
    WHERE u.usuario like '%$name_people%' AND u.id <> $id_user";    

    $resultado_id = mysqli_query($link,$sql);

    if ($resultado_id) {
        while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            echo '<a href="#" class="list-group-item">';
                echo '<strong>'.$registro["usuario"].'</strong> <small> '
                .$registro["email"].'</small>';
                
                echo '<p class="list-group-item-text pull-right ">';
                //Variaveis de controle exibição botões seguir e deixar de seguir
                $seguindo_SN = isset($registro['id_usuario_seguidor']) && !empty($registro['id_usuario_seguidor']) ? 'S' : 'N';
                $btn_seguir_display = 'block';
                $btn_deixar_seguir_display = 'block';

                if ($seguindo_SN == 'N') {
                    $btn_deixar_seguir_display = 'none';
                } else {
                    $btn_seguir_display = 'none';
                }

                //botão seguir
                echo '<button type="button" id= "btn_seguir_'.$registro["id"].'" class="btn btn-default btn_seguir" 
                    data-id_usuario="'.$registro["id"].'" 
                    style="background-color: #00acee; color: white; font-weight: bold; display: '.$btn_seguir_display.'"> 
                    Seguir 
                </button>';
                
                //Botão deixar de seguir
                echo '<button type="button" id= "btn_deixar_seguir_'.$registro["id"].'" class="btn btn-default btn_deixar_seguir" 
                    data-id_usuario="'.$registro["id"].'" 
                    style="background-color: #00acee; color: white; font-weight: bold; display: '.$btn_deixar_seguir_display.'"> 
                    Deixar de seguir 
                </button>';

                echo '</p>';

                echo '<div class="clearfix"></div>';
                echo '</a>';
        }

    } else {
        echo 'Erro na consulta de usuarios no banco de dados';
    }
?>