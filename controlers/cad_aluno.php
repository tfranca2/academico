<?php
	require_once('models/cad_aluno.php');
	$erros = 0;
	$aluno = array();
	
	if(@isset($_POST['salvar']) or @isset($_POST['editar'])){	
		$aluno = array(
			  'aluno' => mysql_real_escape_string(@$_POST['aluno'])
			, 'data_nascimento' => converteData(mysql_real_escape_string(@$_POST['nascimento']))
			, 'cpf' => mysql_real_escape_string(@$_POST['cpf'])
			, 'email' => mysql_real_escape_string(@$_POST['email'])
			, 'turma_id_turma' => mysql_real_escape_string(@$_POST['turma'])
		);
		
		foreach( $aluno as $valor ) {
			if(empty($valor)) {
				$erros = 1;
				alerta("Preencha todos os campos corretamente!");
				break;
			}
		}
		
		if(@isset($_GET['editar']) or @isset($_GET['excluir']))
			$aluno['matricula'] = mysql_real_escape_string(@$_GET['editar']);
			
		if(!$erros){
			if(isset($_POST['salvar'])) 
				cadastrar_aluno($aluno);
			else if(isset($_POST['editar'])) 
				editar_aluno($aluno);
		}
	}else if(@isset($_GET['excluir'])){
		$aluno = array('matricula' => mysql_real_escape_string(@$_GET['excluir']));
		excluir_aluno($aluno);
	}
?>