			<div class="form">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Professor</th>
							<th>Disciplinas</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$crud = new crud('professor');
							$result = $crud->selecionar('',"1 ORDER BY professor");
							if($result){
								foreach($result as $professor){
									?>
									<tr>
										<td><?php echo $professor['professor']; ?></td>
										<td><?php 
									$crud = new crud('disciplina');
										$res = $crud->query("
											SELECT `disciplina` FROM `disciplina` d
											LEFT JOIN `disciplina_professor` dp 
												ON (d.`id_disciplina` = dp.`disciplina_id_disciplina`)
											LEFT JOIN `professor` p 
												ON (p.`id_professor` = dp.`professor_id_professor`)
											WHERE p.`id_professor`  = '".$professor['id_professor']."'
											ORDER BY d.`disciplina`;
										");
										$disc_selecionadas = array();
										foreach($res AS $d)
											$disc_selecionadas[] = $d['disciplina'];
										echo "\n\t\t\t\t\t\t\t\t\t\t\t".'<span class="icon-check"></span> '.implode(' <br />'."\n\t\t\t\t\t\t\t\t\t\t\t".'<span class="icon-check"></span> ', $disc_selecionadas);
										?></td>
										<td>
											<a href="?pagina=cad_professor&editar=<?php echo $professor['id_professor']; ?>" class="btn btn-warning">editar</a>
											<a href="?pagina=cad_professor&excluir=<?php echo $professor['id_professor']; ?>" class="btn btn-danger">excluir</a>
										</td>
									</tr>
								<?php
								}
							}else{
							?>
								<tr>
									<td colspan="6">Sem registros para exibir</td>
								</tr>
							<?php
							}
						?>
					</tbody>
				</table>
			</div>