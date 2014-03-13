<?php
	require_once('models/cad_disciplina.php');
	$erros = 0;
	$disciplina = array();
	
	if(@isset($_POST['salvar']) or @isset($_POST['editar'])){	
		$disciplina = array(
			  'disciplina' => mysql_real_escape_string(@$_POST['disciplina'])
			, 'curso_id_curso' => mysql_real_escape_string(@$_POST['curso'])
		);
		
		foreach( $disciplina as $valor ) {
			if(empty($valor)) {
				$erros = 1;
				alerta("Preencha todos os campos corretamente!");
				break;
			}
		}
		
		if(@isset($_GET['editar']) or @isset($_GET['excluir']))
			$disciplina['id_disciplina'] = mysql_real_escape_string(@$_GET['editar']);
			
		if(!$erros){
			if(isset($_POST['salvar'])) 
				cadastrar_disciplina($disciplina);
			else if(isset($_POST['editar'])) 
				editar_disciplina($disciplina);
		}
	}else if(@isset($_GET['excluir'])){
		$disciplina = array('id_disciplina' => mysql_real_escape_string(@$_GET['excluir']));
		excluir_disciplina($disciplina);
	}
?>