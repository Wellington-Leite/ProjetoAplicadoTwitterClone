<?php 

	require_once('db.class.php');

	$sql = "SELECT * FROM  usuarios";

	$objDb = new db();
    $link = $objDb->conecta_mysql();
    
	$resultado_id = mysqli_query($link, $sql); 

	if ($resultado_id) {		
        $dados_usuario = array();
                        //Forma associativa ou Numérica MYSQLI_NUM
        while($linha = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
            $dados_usuario[] = $linha;
        }

        foreach($dados_usuario as $usuario){
            echo "Indice associativo Usuário: " .$usuario['usuario'];
            echo '<br/>';
            echo "Indice associativo E-mail: " .$usuario['email'];
            echo '<br/>';
            var_dump($usuario);
            echo '<br/><br/>';
        }


        
	} else {        
		echo "Erro na execução da consulta, favor entrar em contato com administrador do site ";
    }
    
 ?>