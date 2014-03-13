<?php
	session_start();
	require_once('funcoes.php');
	require_once('models/crud.class.php');
	
	$pagina = array(
				  "login" => "login.php"
				, "menu" => "menu.php"
				, "welcome" => "welcome.php"
				, "404" => "404.php"
				, "alt_senha" => "alt_senha.php"
				, "rec_senha" => "rec_senha.php"
				, "cad_admin" => "cad_admin.php"
				, "cad_curso" => "cad_curso.php"
				, "cad_turma" => "cad_turma.php"
				, "cad_disciplina" => "cad_disciplina.php"
				, "cad_professor" => "cad_professor.php"
				, "cad_aluno" => "cad_aluno.php"
				, "lis_admin" => "lis_admin.php"
				, "lis_cursos" => "lis_cursos.php"
				, "lis_turmas" => "lis_turmas.php"
				, "lis_disciplinas" => "lis_disciplinas.php"
				, "lis_professores" => "lis_professores.php"
				, "lis_alunos" => "lis_alunos.php"
			);
	$getp = @$_GET['pagina'];
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>Sistema Acad&ecirc;mico</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/> 
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/> 
		<!-- 
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css"/> 
		-->
		<link rel="stylesheet" type="text/css" href="css/custom.css"/> 
		<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-dropdown.min.js"></script>
		<script type="text/javascript" src="js/bootbox.min.js"></script>
		<script type="text/javascript" src="js/bootstrap-select.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
	</head>
	<body>
		<div class="container">
			<?php
				if(@$_SESSION['dados_usuario']['usuario']){
					include $pagina['menu'];
					if(!@$_SESSION['dados_usuario']['senha_alterada']){
						if(isset($getp) and $getp!='login' and $getp!='menu' and $getp!='rec_senha'){
							if(!in_array($getp,array_keys($pagina)))
								@include $pagina['404'];
							else
								@include $pagina[$getp];
						}else
							include $pagina['welcome'];
					}else
						include $pagina['alt_senha'];
				} elseif(isset($getp) and $getp == 'rec_senha'){
					include $pagina['rec_senha'];
				}else
					include $pagina['login'];
			?>
		</div>
	</body>
</html>