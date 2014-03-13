			<div class="form">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Disciplina</th>
							<th>Curso</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$crud = new crud('disciplina');
							$result = $crud->query('
								SELECT * FROM disciplina d
								LEFT JOIN curso c
								ON d.curso_id_curso = c.id_curso
								ORDER BY d.disciplina;');
							if($result){
								foreach($result as $disciplina){
									?>
									<tr>
										<td><?php echo $disciplina['disciplina']; ?></td>
										<td><?php echo $disciplina['curso']; ?></td>
										<td>
											<a href="?pagina=cad_disciplina&editar=<?php echo $disciplina['id_disciplina']; ?>" class="btn btn-warning">editar</a>
											<a href="?pagina=cad_disciplina&excluir=<?php echo $disciplina['id_disciplina']; ?>" class="btn btn-danger">excluir</a>
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