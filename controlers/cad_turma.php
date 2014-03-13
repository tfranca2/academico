<?php
	require_once('models/cad_turma.php');
	$erros = 0;
	$turma = array();
	
	if(@isset($_POST['salvar']) or @isset($_POST['editar'])){	
		$turma = array(
			  'turma' => mysql_real_escape_string(@$_POST['turma'])
			, 'curso_id_curso' => mysql_real_escape_string(@$_POST['curso'])
		);
		
		foreach( $turma as $valor ) {
			if(empty($valor)) {
				$erros = 1;
				alerta("Preencha todos os campos corretamente!");
				break;
			}
		}
		
		if(@isset($_GET['editar']) or @isset($_GET['excluir']))
			$turma['id_turma'] = mysql_real_escape_string(@$_GET['editar']);
			
		if(!$erros){
			if(isset($_POST['salvar'])) 
				cadastrar_turma($turma);
			else if(isset($_POST['editar'])) 
				editar_turma($turma);
		}
	}else if(@isset($_GET['excluir'])){
		$turma = array('id_turma' => mysql_real_escape_string(@$_GET['excluir']));
		excluir_turma($turma);
	}
?>