<?php
	require_once('controlers/cad_professor.php');
	
	if(@isset($_GET['editar'])){
		$editar = MD5($_GET['editar']);
		$crud = new crud('professor');
		$result = $crud->selecionar('',"MD5(`id_professor`)='".$editar."' LIMIT 1");
		
	} else if(@isset($_GET['excluir'])){
		$excluir = MD5($_GET['excluir']);
	}
?>
			<form action="" method="post" class="form">
				<div class="delimiter">
					<label>  <input type="text" name="professor" <?php @printf('value="%s"',$result[0]['professor']); ?> placeholder="Professor:" class="input-block-level" /> </label>
					<fieldset>
						<legend>Disciplinas</legend>
							<div class="frame">
							<?php
								$crud = new crud('disciplina');
								if($editar){
									$res = $crud->query("
										SELECT `id_disciplina` FROM `disciplina` d
										LEFT JOIN `disciplina_professor` dp 
											ON (d.`id_disciplina` = dp.`disciplina_id_disciplina`)
										LEFT JOIN `professor` p 
											ON (p.`id_professor` = dp.`professor_id_professor`)
										WHERE MD5(p.`id_professor`) = '".$editar."'
										ORDER BY d.`disciplina`;
									");
									$disc_selecionadas = array();
									foreach($res AS $d)
										$disc_selecionadas[] = $d['id_disciplina'];
								}
								$res = $crud->selecionar("","1 ORDER BY disciplina");
								if($res){
									foreach($res as $disciplina){?>

							<label class="checkbox"><input type="checkbox" name="disciplinas[]" value="<?php echo $disciplina['id_disciplina']; ?>" <?php if(in_array($disciplina['id_disciplina'], $disc_selecionadas)){echo "checked"; } ?> /> <?php echo $disciplina['disciplina']; ?></label><?php
									}
								}else{ echo "Sem disciplinas cadastradas."; }
							?>

							</div>
					</fieldset>
					
					<input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger btn-block" onclick='location.href="?pagina=lis_professores"' />
					<input type="submit" name="<?php echo (@$result[0]['professor'])?"editar":"salvar"; ?>" value="Salvar" class="btn btn-large btn-success btn-block" />
				</div>
			</form>