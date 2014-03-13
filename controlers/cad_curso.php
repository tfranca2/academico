<?php
	require_once('models/cad_curso.php');
	$erros = 0;
	$curso = array();
	
	if(@isset($_POST['salvar']) or @isset($_POST['editar'])){	
		$curso = array(
			  'curso' => mysql_real_escape_string(@$_POST['curso'])
		);
		
		foreach( $curso as $valor ) {
			if(empty($valor)) {
				$erros = 1;
				alerta("Preencha todos os campos corretamente!");
				break;
			}
		}
		
		if(@isset($_GET['editar']) or @isset($_GET['excluir']))
			$curso['id_curso'] = mysql_real_escape_string(@$_GET['editar']);
			
		if(!$erros){
			if(isset($_POST['salvar']))
				cadastrar_curso($curso);
			else if(isset($_POST['editar']))
				editar_curso($curso);
		}
	}else if(@isset($_GET['excluir'])){
		$curso = array('id_curso' => mysql_real_escape_string(@$_GET['excluir']));
		excluir_curso($curso);
	}
?>