<?php 

class db {
	//host
	private $host = 'localhost';

	//usuario
	private $usuario = 'root';

	//senha
	private $senha = '';

	//banco de dados
	private $database = 'twitter_clone';

	public function conecta_mysql(){

		//criar conexão
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);

		// ajustar o charset, comunicação entre o php e mysql utilizando UTF8
		mysqli_set_charset($con, 'utf8');

		//verificar se houve algum erro de conexao
		if (mysqli_connect_errno()) {
			echo "Erro ao tentar se conectar com BD MySQL:" .mysqli_connect_error();
		}
		return $con;
	} 

}

?>