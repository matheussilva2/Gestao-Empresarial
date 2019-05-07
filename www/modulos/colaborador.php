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

    function checkarAutorizacao($privilegio){
        $colaborador = getUserByToken($_COOKIE['_session']);
        if($colaborador['permissao'] >= $privilegio){
        $pagina_autorizacao=$privilegio."
        <div class='container mt-4 text-center'>
            <h2 class='mb-3'>Você não têm permissão para acessar essa página!</h2>
            <a class='btn btn-primary' href='./colaborador.php'>Voltar para o início</a>
        </div>
        ";
        die($pagina_autorizacao);
    }
    }

	function getUserByToken($token){
        $prepare = conectar()->prepare('
            SELECT colaborador.permissao, colaborador.matricula, colaborador.cpf, colaborador.nome,
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

    function getQuantidadeVendas($matricula, $dataInicio, $dataFim){
        $con = conectar();
        $sql = "SELECT sum(quantidade) as quantidade, sum(valor) as valor
                FROM venda
                WHERE matricula_vendedor= :matricula
                AND (data between :data_inicio and :data_fim)";
        $prepare = $con->prepare($sql);
        $prepare->execute([
            'matricula' => $matricula,
            'data_inicio'=>$dataInicio,
            'data_fim' => $dataFim
        ]);
        $vendas = $prepare->fetch();
        
        return $vendas;
    }

    function getMediaVendas($matricula, $dataInicio, $dataFim){
        $con = conectar();
        $sql = "SELECT avg(quantidade) as quantidade, avg(valor) as valor
                FROM venda
                WHERE matricula_vendedor= :matricula
                AND (data between :data_inicio and :data_fim)";
        $prepare = $con->prepare($sql);
        $prepare->execute([
            'matricula' => $matricula,
            'data_inicio'=>$dataInicio,
            'data_fim' => $dataFim
        ]);
        return $prepare->fetch();
    }
?>