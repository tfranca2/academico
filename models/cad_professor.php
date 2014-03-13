<?php
	require_once('crud.class.php');

	function cadastrar_professor($professor){
		$disciplinas = $professor['disciplinas'];
		unset($professor['disciplinas']);
		
		$campos = "`".implode("`, `", array_keys($professor))."`";
		$valores = "'".implode("', '", $professor)."'";

		$crud = new crud('professor');	
		$crud->inserir($campos,$valores);
		
		$result = $crud->selecionar('`id_professor`',"`professor`='".$professor['professor']."' LIMIT 1");
		$pro['id_professor'] = $result[0]['id_professor'];
		$pro['disciplinas'] = $disciplinas;

		cria_FK_disciplina_professor($pro);
		
		header('location: ?pagina=lis_professores');
	}
	
	function editar_professor($professor){
		remove_FK_disciplina_professor($professor);
		cria_FK_disciplina_professor($professor);
		
		$id = $professor['id_professor'];
		unset($professor['id_professor']);
		unset($professor['disciplinas']);
		
		$campos = array_keys($professor);
		$valores = array_values($professor);

		for($i=0;$i<count($professor);$i++)
			@$camposvalores .= " `".$campos[$i]."` = '".$valores[$i]."',";
		$camposvalores = substr($camposvalores, 0, strlen($camposvalores)-1);
		
		$crud = new crud('professor');
		$crud->atualizar($camposvalores, "MD5(`id_professor`)='".MD5($id)."'");
		
		
		header('location: ?pagina=lis_professores');
	}
	
	function excluir_professor($professor){
		if(!empty($professor['id_professor'])){
			remove_FK_disciplina_professor($professor);
			$crud = new crud('professor');
			$crud->deletar("MD5(`id_professor`)='".MD5($professor['id_professor'])."'");
			header('location: ?pagina=lis_professores');
		}
	}
	
	function cria_FK_disciplina_professor($professor){
		$campos = "`disciplina_id_disciplina`, `professor_id_professor`";
		$valores = $professor['disciplinas'];
		
		$crud = new crud('disciplina_professor');	
		foreach($valores as $disciplina){
			$crud->inserir($campos,"'$disciplina', '$professor[id_professor]'");
		}
	}

	function remove_FK_disciplina_professor($professor){
		$crud = new crud('disciplina_professor');	
		$crud->deletar("MD5(`professor_id_professor`)='".MD5($professor['id_professor'])."'");
	}
?>