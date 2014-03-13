			<div class="form">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Usuario</th>
							<th>E-mail</th>
							<th>Administrador</th>
							<th>Ativo</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$crud = new crud('usuario');
							$result = $crud->selecionar('','1 ORDER BY usuario');
							if($result){
								foreach($result as $user){
									?>
									<tr>
										<td><?php echo $user['usuario']; ?></td>
										<td><?php echo $user['email']; ?></td>
										<td><span class="icon-<?php
										if($user['admin']) echo "ok";
										else echo "remove";?>"></span></td>
										<td><span class="icon-<?php
										if($user['ativo']) echo "ok";
										else echo "remov";?>"></span></td>
										<td>
											<a href="?pagina=cad_admin&editar=<?php echo $user['id_usuario']; ?>" class="btn btn-warning">editar</a>
											<a href="?pagina=cad_admin&excluir=<?php echo $user['id_usuario']; ?>" class="btn btn-danger">excluir</a>
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