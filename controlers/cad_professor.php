<?php
	require_once('models/cad_professor.php');
	$erros = 0;
	$professor = array();
	
	if(@isset($_POST['salvar']) or @isset($_POST['editar'])){	
		$professor = array(
			    'professor' => mysql_real_escape_string(@$_POST['professor'])
		);

		foreach( $professor as $valor ) {
			if(empty($valor)) {
				$erros = 1;
				alerta("Preencha todos os campos corretamente!");
				break;
			}
		}
		
		$disciplinas = array();
		foreach($_POST['disciplinas'] as $d){
			$disciplinas[] = mysql_real_escape_string($d);
		}
		$professor['disciplinas'] = $disciplinas;
		
		if(@isset($_GET['editar']) or @isset($_GET['excluir']))
			$professor['id_professor'] = mysql_real_escape_string(@$_GET['editar']);
			
		if(!$erros){
			if(isset($_POST['salvar']))
				cadastrar_professor($professor);
			else if(isset($_POST['editar']))
				editar_professor($professor);
		}
	}else if(@isset($_GET['excluir'])){
		$professor = array('id_professor' => mysql_real_escape_string(@$_GET['excluir']));
		excluir_professor($professor);
	}
?>