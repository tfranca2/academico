<?php
	require_once('controlers/cad_curso.php');
	
	if(@isset($_GET['editar'])){
		$editar = MD5($_GET['editar']);
		$crud = new crud('curso');
		$result = $crud->selecionar('',"MD5(`id_curso`)='".$editar."' LIMIT 1");
		
	} else if(@isset($_GET['excluir'])){
		$excluir = MD5($_GET['excluir']);
	}
?>
			<form action="" method="post" class="form">
				<div class="delimiter">
					<label>  <input type="text" name="curso" <?php @printf('value="%s"',$result[0]['curso']); ?> placeholder="Curso:" class="input-block-level" /> </label>
					<input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger btn-block" onclick='location.href="?pagina=lis_cursos"' />
					<input type="submit" name="<?php echo (@$result[0]['curso'])?"editar":"salvar"; ?>" value="Salvar" class="btn btn-large btn-success btn-block" />
				</div>
			</form>