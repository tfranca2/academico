<?php
	require_once('models/cad_admin.php');
	$erros = 0;
	$usuario = array();
	
	if(@isset($_POST['salvar']) or @isset($_POST['editar'])){	
		$usuario = array(
			  'usuario' => mysql_real_escape_string(@$_POST['usuario'])
			, 'email' => mysql_real_escape_string(@$_POST['email'])
		);
		if(@isset($_POST['salvar'])){
			if(@isset($_POST['senha']) and @!empty($_POST['senha'])){
				$usuario['senha'] = md5(@$_POST['senha']);
			}else{
				$erros = 1;
				alerta("A senha n&atilde;o pode ser vazia!");
			}
		}		
			
		foreach( $usuario as $valor ) {
			if(empty($valor)) {
				$erros = 1;
				alerta("Preencha todos os campos corretamente!");
				break;
			}
		}
		
		$usuario['ativo'] = (!empty($_POST['ativo']))?1:0 ;
		$usuario['admin'] = (!empty($_POST['admin']))?1:0 ;
		
		if(@isset($_GET['editar']) or @isset($_GET['excluir']))
			$usuario['id_usuario'] = mysql_real_escape_string(@$_GET['editar']);
			
		
		if(@isset($_POST['editar'])){
			if(@isset($_POST['senha']) and @!empty($_POST['senha'])){
				$usuario['senha'] = md5(@$_POST['senha']);
				$usuario['senha_alterada'] = 1;
			}
		}
			
		if(!$erros){
			if(isset($_POST['salvar']))
				cadastrar_usuario($usuario);
			else if(isset($_POST['editar']))
				editar_usuario($usuario);
		}
	}else if(@isset($_GET['excluir'])){
		$usuario = array('id_usuario' => mysql_real_escape_string(@$_GET['excluir']));
		excluir_usuario($usuario);
	}else if(@isset($_POST['alterar_senha'])){
		$usuario = array(
			  'senha_atual' => MD5(@$_POST['senha_atual'])
			, 'nova_senha' => MD5(@$_POST['nova_senha'])
			, 'repita_senha' => MD5(@$_POST['repita_senha'])
		);
		
		foreach( $usuario as $valor ) {
			if(empty($valor)) {
				$erros = 1;
				alerta("Preencha todos os campos corretamente!");
				break;
			}
		}
		
		if($usuario['senha_atual'] == $_SESSION['dados_usuario']['senha']){
			if($usuario['nova_senha'] == $usuario['repita_senha']){
				$senha = $usuario['nova_senha'];
				$usuario = array(
					  'id_usuario' => $_SESSION['dados_usuario']['id_usuario']
					, 'senha' => $senha
					, 'senha_alterada' => 0
				);
				editar_usuario($usuario);
				header("location: logout.php");
			}
		}
	}else if(@isset($_POST['recuperar_senha'])){
		if(@isset($_POST['email'])){
			if(validaEmail($_POST['email'])){
				$usuario = array( 'email' => $_POST['email']);
				recuperar_senha($usuario);
			} else
				alerta("E-mail inv&aacute;lido!");
		}
	}
?>