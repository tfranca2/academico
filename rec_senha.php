<?php
	require_once('controlers/cad_admin.php');
?>
<div class="form">
	<h4 style="width:640px; margin-left: auto;">Preencha seu e-mail para recuperação de senha:</h4>
	<div class="delimiter">
		<form action="" method="post">
			<br/>
			<input type="text" name="email" class="input-block-level" placeholder="E-mail" /> <br/><br/>
			<input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger btn-block" onclick='location.href="index.php"' />
			<input type="submit" name="recuperar_senha" value="Enviar" class="btn btn-large btn-block btn-primary" />
		</form>
	</div>
</div>