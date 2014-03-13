<?php
	require_once('controlers/cad_admin.php');
?>
<form action="" method="post" class="form">
	<div class="delimiter">
		<input type="password" required name="senha_atual" placeholder="Senha Atual:" class="input-block-level" />
		<input type="password" required name="nova_senha" placeholder="Nova Senha:" class="input-block-level" />
		<input type="password" required name="repita_senha" placeholder="Repita a Senha:" class="input-block-level" />
		<input type="reset" value="Cancelar" class="btn btn-danger btn-block" onclick='location.href="index.php"' />
		<input type="submit" name="alterar_senha" class="btn btn-large btn-success btn-block" value="Salvar"/>
	</div>
</form>