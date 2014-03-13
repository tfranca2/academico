<?php
	require_once('crud.class.php');

	function cadastrar_disciplina($disciplina){
		$campos = "`".implode("`, `", array_keys($disciplina))."`";
		$valores = "'".implode("', '", $disciplina)."'";

		$crud = new crud('disciplina');	
		$crud->inserir($campos,$valores);
		header('location: ?pagina=lis_disciplinas');
	}
	
	function editar_disciplina($disciplina){
		$id = $disciplina['id_disciplina'];
		unset($disciplina['id_disciplina']);
		$campos = array_keys($disciplina);
		$valores = array_values($disciplina);

		for($i=0;$i<count($disciplina);$i++)
			@$camposvalores .= " `".$campos[$i]."` = '".$valores[$i]."',";
		$camposvalores = substr($camposvalores, 0, strlen($camposvalores)-1);
		$crud = new crud('disciplina');
		$crud->atualizar($camposvalores, "MD5(`id_disciplina`)='".MD5($id)."'");
		header('location: ?pagina=lis_disciplinas');
	}
	
	function excluir_disciplina($disciplina){
		if(!empty($disciplina['id_disciplina'])){
			remove_FK_disciplina_professor($disciplina);
			$crud = new crud('disciplina');
			$crud->deletar("MD5(`id_disciplina`)='".MD5($disciplina['id_disciplina'])."'");
			header('location: ?pagina=lis_disciplinas');
		}
	}
	
	function remove_FK_disciplina_professor($disciplina){
		$crud = new crud('disciplina_professor');	
		$crud->deletar("MD5(`disciplina_id_disciplina`)='".MD5($disciplina['id_disciplina'])."'");
	}
?>