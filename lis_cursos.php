			<div class="form">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Curso</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$crud = new crud('curso');
							$result = $crud->selecionar('','1 ORDER BY curso');
							if($result){
								foreach($result as $curso){
									?>
									<tr>
										<td><?php echo $curso['curso']; ?></td>
										<td>
											<a href="?pagina=cad_curso&editar=<?php echo $curso['id_curso']; ?>" class="btn btn-warning">editar</a>
											<a href="?pagina=cad_curso&excluir=<?php echo $curso['id_curso']; ?>" class="btn btn-danger">excluir</a>
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