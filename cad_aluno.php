<?php
	require_once('controlers/cad_aluno.php');
	require_once('models/crud.class.php');
	
	if(@isset($_GET['editar'])){
		$editar = MD5($_GET['editar']);
		$crud = new crud('aluno');
		$result = $crud->selecionar('',"MD5(`matricula`)='".$editar."' LIMIT 1");
		
	} else if(@isset($_GET['excluir'])){
		$excluir = MD5($_GET['excluir']);
	}
?>

<script type="text/javascript">
	function validar(form) {
		regex1 = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
		if( !regex1.exec(form.cpf.value) ) {
			form.cpf.focus();
			bootbox.alert("CPF inv&aacute;lido!");
			return false;
		}
		regex2 = /^[A-Za-z0-9][A-Za-z0-9_\-\.]+\@[A-Za-z]+(\.([A-Za-z]{3,})+(\.[A-Za-z]{2,})*)$/; 
		if( !regex2.exec(form.email.value) ) {
			form.email.focus();
			bootbox.alert("E-mail inv&aacute;lido!");
			return false;
		}
	}
</script>


			<form action="" method="post" class="form" onsubmit="return validar(this)">
				<div class="delimiter">
					<label>  <input type="text" name="aluno" <?php @printf('value="%s"',$result[0]['aluno']); ?> placeholder="Aluno:" class="input-block-level" /> </label>
					<label>  <input type="text" id="data" name="nascimento" <?php @printf('value="%s"',converteData($result[0]['data_nascimento'])); ?> placeholder="Data de Nascimento:" class="input-block-level" /> </label>
					<label>  <input type="text" name="cpf" <?php @printf('value="%s"',$result[0]['cpf']); ?> placeholder="CPF:" class="input-block-level" /> </label>
					<label>  <input type="text" name="email" <?php @printf('value="%s"',$result[0]['email']); ?> placeholder="E-mail:" class="input-block-level"/> </label>
					<label>Turma:
					<select name="turma" id="turma" class="selectpicker"><option value=""></option>
					 <?php
					$crud = new crud('turma');
					$t = $crud->selecionar('',"");
					foreach($t as $turma){
						if(@$turma['id_turma'] == @$result[0]['turma_id_turma'])
							echo "\n\t\t\t".'<option value="'.$turma['id_turma'].'" selected>'.$turma['turma'].'</option>';		
						else
							echo "\n\t\t\t".'<option value="'.$turma['id_turma'].'">'.$turma['turma'].'</option>';
					}
					?>
					</select> </label>
					<script type="text/javascript">
					  $(document).ready(function(e) {
						  $('.selectpicker').selectpicker();
					  });
					</script>
					<input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger btn-block" onclick='location.href="?pagina=lis_alunos"' />
					<input type="submit" name="<?php echo (@$result[0]['aluno'])?"editar":"salvar"; ?>" value="Salvar" class="btn btn-large btn-success btn-block" />
				</div>
			</form>