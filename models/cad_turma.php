<?php
	require_once('crud.class.php');

	function cadastrar_turma($turma){
		$campos = "`".implode("`, `", array_keys($turma))."`";
		$valores = "'".implode("', '", $turma)."'";

		$crud = new crud('turma');	
		$crud->inserir($campos,$valores);
		header('location: ?pagina=lis_turmas');
	}
	
	function editar_turma($turma){
		$id = $turma['id_turma'];
		unset($turma['id_turma']);
		$campos = array_keys($turma);
		$valores = array_values($turma);

		for($i=0;$i<count($turma);$i++)
			@$camposvalores .= " `".$campos[$i]."` = '".$valores[$i]."',";
		$camposvalores = substr($camposvalores, 0, strlen($camposvalores)-1);
		$crud = new crud('turma');
		$crud->atualizar($camposvalores, "MD5(`id_turma`)='".MD5($id)."'");
		header('location: ?pagina=lis_turmas');
	}
	
	function excluir_turma($turma){
		if(!empty($turma['id_turma'])){
			$crud = new crud('turma');
			$crud->deletar("MD5(`id_turma`)='".MD5($turma['id_turma'])."'");
			header('location: ?pagina=lis_turmas');
		}
	}
?>