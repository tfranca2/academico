<?php
	require_once('controlers/cad_turma.php');
	require_once('models/crud.class.php');
	
	if(@isset($_GET['editar'])){
		$editar = MD5($_GET['editar']);
		$crud = new crud('turma');
		$result = $crud->selecionar('',"MD5(`id_turma`)='".$editar."' LIMIT 1");
		
	} else if(@isset($_GET['excluir'])){
		$excluir = MD5($_GET['excluir']);
	}
?>
			<form action="" method="post" class="form">
				<div class="delimiter">
					<label>  <input type="text" name="turma" <?php @printf('value="%s"',$result[0]['turma']); ?> placeholder="Turma:" class="input-block-level" /> </label>
					<label>Curso:
					<select name="curso" id="curso" class="selectpicker"><option value=""></option>
					 <?php
					$crud = new crud('curso');
					$c = $crud->selecionar('',"");
					foreach($c as $curso){
						if(@$curso['id_curso'] == @$result[0]['curso_id_curso'])
							echo "\n\t\t\t".'<option value="'.$curso['id_curso'].'" selected>'.$curso['curso'].'</option>';		
						else
							echo "\n\t\t\t".'<option value="'.$curso['id_curso'].'">'.$curso['curso'].'</option>';
					}
					?>
					</select> </label>
					<script type="text/javascript">
					  $(document).ready(function(e) {
						  $('.selectpicker').selectpicker();
					  });
					</script>
					<input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger btn-block" onclick='location.href="?pagina=lis_turmas"' />
					<input type="submit" name="<?php echo (@$result[0]['turma'])?"editar":"salvar"; ?>" value="Salvar" class="btn btn-large btn-success btn-block" />
				</div>
			</form>