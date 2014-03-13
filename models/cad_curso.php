<?php
	require_once('crud.class.php');

	function cadastrar_curso($curso){
		$campos = "`".implode("`, `", array_keys($curso))."`";
		$valores = "'".implode("', '", $curso)."'";

		$crud = new crud('curso');	
		$crud->inserir($campos,$valores);
		header('location: ?pagina=lis_cursos');
	}
	
	function editar_curso($curso){
		$id = $curso['id_curso'];
		unset($curso['id_curso']);
		$campos = array_keys($curso);
		$valores = array_values($curso);

		for($i=0;$i<count($curso);$i++)
			@$camposvalores .= " `".$campos[$i]."` = '".$valores[$i]."',";
		$camposvalores = substr($camposvalores, 0, strlen($camposvalores)-1);
		
		$crud = new crud('curso');
		$crud->atualizar($camposvalores, "MD5(`id_curso`)='".MD5($id)."'");
		header('location: ?pagina=lis_cursos');
	}
	
	function excluir_curso($curso){
		if(!empty($curso['id_curso'])){
			$crud = new crud('curso');
			$crud->deletar("MD5(`id_curso`)='".MD5($curso['id_curso'])."'");
			header('location: ?pagina=lis_cursos');
		}
	}
?>