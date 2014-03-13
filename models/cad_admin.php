<?php
	require_once('crud.class.php');

	function cadastrar_usuario($usuario){
		$crud = new crud('usuario');	
		if($crud->selecionar("usuario","MD5(`usuario`)='".MD5($usuario['usuario'])."'")){
			alerta("Usu&aacute;rio j&aacute; cadastrado!");
		}else{
			$keys = array_keys($usuario);
			
			$campos = "`".implode("`, `", $keys)."`";
			$valores = "'".implode("', '", $usuario)."'";
			
			$crud->inserir($campos,$valores);
			header('location: ?pagina=lis_admin');
		}
	}
	
	function editar_usuario($usuario){
		$id = $usuario['id_usuario'];
		unset($usuario['id_usuario']);
		$campos = array_keys($usuario);
		$valores = array_values($usuario);

		for($i=0;$i<count($usuario);$i++)
			@$camposvalores .= " `".$campos[$i]."` = '".$valores[$i]."',";
		$camposvalores = substr($camposvalores, 0, strlen($camposvalores)-1);
		
		$crud = new crud('usuario');
		$crud->atualizar($camposvalores, "MD5(`id_usuario`)='".MD5($id)."'");
		header('location: ?pagina=lis_admin');
	}
	
	function excluir_usuario($usuario){
		if(!empty($usuario['id_usuario'])){
			$crud = new crud('usuario');
			$crud->deletar("MD5(`id_usuario`)='".MD5($usuario['id_usuario'])."'");
			header('location: ?pagina=lis_admin');
		}
	}

	function recuperar_senha($usuario){
		if(!empty($usuario['email'])){
			$crud = new crud('usuario');
			$result = $crud->selecionar('`id_usuario`,`usuario`, `email`',"`email` = '$usuario[email]'");
			$usuario = $result[0];
			if(isset($usuario['id_usuario'])){
				$novaSenha = nomeRandomico();
				$usuario['senha'] = MD5($novaSenha);
				$usuario['senha_alterada'] = 1;

				$destinatario = $usuario['email'];
				$nomeUsuario = $usuario['usuario'];
				$titulo = "Sua nova senha do sistema.";
				$msg = '<br/>Sua senha tempor&aacute;ria do sistema &eacute;: <strong>'.$novaSenha.'</strong><br/>Acesse seu usu&aacute;rio e troque sua senha.<br/>';

				unset($usuario['email']);
				unset($usuario['usuario']);
				
				editar_usuario($usuario);
				
				if(enviarEmail($destinatario, $nomeUsuario, $titulo, $msg)){
					alerta("E-mail enviado com sucesso!");
					redirecionarPara('index.php');
				} else
					alerta("Problemas de envio de e-mail.");
			}else
				alerta("E-mail n&atilde;o cadastrado");
		}
	}
?>