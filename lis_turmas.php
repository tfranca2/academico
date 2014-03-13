			<div class="form">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Turma</th>
							<th>Curso</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$crud = new crud('turma');
							$result = $crud->query('
								SELECT * FROM turma t
								LEFT JOIN curso c
								ON t.curso_id_curso = c.id_curso
								ORDER BY t.turma;');
							if($result){
								foreach($result as $turma){
									?>
									<tr>
										<td><?php echo $turma['turma']; ?></td>
										<td><?php echo $turma['curso']; ?></td>
										<td>
											<a href="?pagina=cad_turma&editar=<?php echo $turma['id_turma']; ?>" class="btn btn-warning">editar</a>
											<a href="?pagina=cad_turma&excluir=<?php echo $turma['id_turma']; ?>" class="btn btn-danger">excluir</a>
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