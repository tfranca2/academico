<?php
	require_once('controlers/cad_admin.php');
	
	if(@isset($_GET['editar'])){
		$editar = MD5($_GET['editar']);
		$crud = new crud('usuario');
		$result = $crud->selecionar('',"MD5(`id_usuario`)='".$editar."' LIMIT 1");
	} else if(@isset($_GET['excluir'])){
		$excluir = MD5($_GET['excluir']);
	}
?>

<script type="text/javascript">
	function validar(form) {
		regex = /^[A-Za-z0-9][A-Za-z0-9_\-\.]+\@[A-Za-z]+(\.([A-Za-z]{3,})+(\.[A-Za-z]{2,})*)$/; 
		if( !regex.exec(form.email.value) ) {
			form.email.focus();
			bootbox.alert("E-mail inv&aacute;lido!");
			return false;
		}
	}
</script>

			<form action="" method="post" class="form" onsubmit="return validar(this)">
				<div class="delimiter">
					<label>  <input type="text" name="usuario" <?php @printf('value="%s"',$result[0]['usuario']); ?> placeholder="Usu&aacute;rio:" class="input-block-level" /> </label>
					<label>  <input type="text" name="email" <?php @printf('value="%s"',$result[0]['email']); ?> placeholder="E-mail:" class="input-block-level" /> </label>
					<label>  <input type="password" name="senha" placeholder="Senha:" class="input-block-level" /> </label>
					<label class="checkbox">
						<input type="checkbox" name="ativo" <?php 
						if(@isset($_GET['editar']))
							echo (@$result[0]['ativo'])?" checked ":"";
						else
							echo " checked ";
						
						?> />Ativo</label>
					<label class="checkbox">
						<input type="checkbox" name="admin" <?php 
						if(@isset($_GET['editar']))
							echo (@$result[0]['admin'])?" checked ":"";
						else
							echo " checked ";
						
						?> />Administrador</label>
					<br />
					<input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger btn-block" onclick='location.href="?pagina=lis_admin"' />
					<input type="submit" name="<?php echo (@$result[0]['usuario'])?"editar":"salvar"; ?>" value="Salvar" class="btn btn-large btn-success btn-block" />
				</div>
			</form>