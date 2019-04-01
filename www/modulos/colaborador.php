<?php
	require_once('database.php');
	require_once('Authorization.php');

	function procurarTodosColaboradores(){
		$con = conectar();
		$sql = "SELECT * FROM colaborador";
		$prepare = $con->prepare($sql);
		$prepare->execute();
		return $prepare->fetchAll();
	}

	function getQuantidadeVendas(){
		echo "OKOK";
	}

	function getUserByToken($token){
        $prepare = conectar()->prepare('
            SELECT colaborador.matricula, colaborador.cpf, colaborador.nome,
            colaborador.nascimento, colaborador.rg, colaborador.cargo
            FROM colaborador
            INNER JOIN user_session
            ON
                user_session.token = :token
            AND
                user_session.matricula = colaborador.matricula;
        ');

        $prepare->execute([
            'token' => $token,
        ]);
        return $prepare->fetch();
    }
?>