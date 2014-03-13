			<div class="form">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Matricula</th>
							<th>Aluno</th>
							<th>Idade</th>
							<th>E-mail</th>
							<th>Turma</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$crud = new crud('aluno');
							$result = $crud->query("
								SELECT 
									a.`matricula`, 
									a.`aluno`,  
									a.`email`,  
									(YEAR(CURDATE())-YEAR(a.`data_nascimento`)) AS `idade`,
									t.`turma`
								FROM aluno a
									LEFT JOIN turma t ON a.turma_id_turma = t.id_turma
								ORDER BY a.aluno;
								");
							if($result){
								foreach($result as $aluno){
									?>
									<tr>
										<td><?php echo $aluno['matricula']; ?></td>
										<td><?php echo $aluno['aluno']; ?></td>
										<td><?php echo $aluno['idade']; ?></td>
										<td><?php echo $aluno['email']; ?></td>
										<td><?php echo $aluno['turma']; ?></td>
										<td>
											<a href="?pagina=cad_aluno&editar=<?php echo $aluno['matricula']; ?>" class="btn btn-warning">editar</a>
											<a href="?pagina=cad_aluno&excluir=<?php echo $aluno['matricula']; ?>" class="btn btn-danger">excluir</a>
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