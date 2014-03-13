<?php
	require_once('crud.class.php');

	function cadastrar_aluno($aluno){
		$campos = "`".implode("`, `", array_keys($aluno))."`";
		$valores = "'".implode("', '", $aluno)."'";

		$crud = new crud('aluno');	
		$crud->inserir($campos,$valores);
		header('location: ?pagina=lis_alunos');
	}
	
	function editar_aluno($aluno){
		$id = $aluno['matricula'];
		unset($aluno['matricula']);
		$campos = array_keys($aluno);
		$valores = array_values($aluno);

		for($i=0;$i<count($aluno);$i++)
			@$camposvalores .= " `".$campos[$i]."` = '".$valores[$i]."',";
		$camposvalores = substr($camposvalores, 0, strlen($camposvalores)-1);
		$crud = new crud('aluno');
		$crud->atualizar($camposvalores, "MD5(`matricula`)='".MD5($id)."'");
		header('location: ?pagina=lis_alunos');
	}
	
	function excluir_aluno($aluno){
		if(!empty($aluno['matricula'])){
			$crud = new crud('aluno');
			$crud->deletar("MD5(`matricula`)='".MD5($aluno['matricula'])."'");
			header('location: ?pagina=lis_alunos');
		}
	}
?>