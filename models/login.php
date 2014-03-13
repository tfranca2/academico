<?php
	require_once('crud.class.php');
	require_once('conexao.class.php');
	@session_start();
	
	
	function fazerLogin($usuario, $senha){
			$crud = new crud("usuario");
			$result = $crud->selecionar("","MD5(`usuario`) = '".MD5($usuario)."' AND ativo = 1 LIMIT 1 ");
			if(MD5($senha)==$result[0]['senha']){
				inicializaSession($result);
				return true;
			} else {
				return false;
			}
		
	}
	
	function inicializaSession($result){
		$_SESSION['dados_usuario'] = array(
			  'id_usuario' => $result[0]['id_usuario']
			, 'usuario' => $result[0]['usuario']
			, 'email' => $result[0]['email']
			, 'senha' => $result[0]['senha']
			, 'senha_alterada' => $result[0]['senha_alterada']
			, 'admin' => $result[0]['admin']
			, 'ativo' => $result[0]['ativo']
		);
	}
?>