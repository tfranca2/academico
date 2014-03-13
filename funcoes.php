<?php
	require_once('models/PHPMailer_5.2.4/class.phpmailer.php');
    protegeArquivo(basename( __FILE__ ));
	
	@session_start();
	
   //define('BASE_URL','localhost/cws/');
	date_default_timezone_set("America/Fortaleza");
	
    function protegeArquivo($nomeArquivo) {
        $url = strtoupper($_SERVER['PHP_SELF']);
		$nomeArquivo = strtoupper($nomeArquivo);
        if( strpos($url, $nomeArquivo) )
            header("Location: index.php");
    }
    
    function criptografar($string){
        return md5($string);
    }
    
    function verificaLogin() {
        if(!$_SESSION['usuario_ativo'] )
			return false;
		else
			return true;
    }
	
	function incluiPagina($localdoarquivo) {
		if(file_exists($localdoarquivo)){
			require_once($localdoarquivo);
		}
	}
	
	function nomeMesPtBr($indice, $tipo){
		$mes = array(
			"Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", 
			"Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro", "Jan", "Fev", "Mar", "Abr", "Mai", "Jun", 
			"Jul", "Ago", "Set", "Out", "Nov", "Dez"
		);
		return $mes[ ($tipo)?$indice-1:$indice+11 ];
	}
	
	function nomeDiaPtBr($indice, $tipo){
		$mes = array(
			"Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"
			, "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"
		);
		return $mes[ ($tipo)?$indice:$indice+7 ];
	}
	
	function alerta($msg){
		if(isset($msg))
			echo "<script type=\"text/javascript\">bootbox.alert(\"$msg\");</script> ";
	}
	
	function redirecionarPara($pagina){
		if(isset($pagina))
			echo '<meta http-equiv="refresh" content="1; url='.$pagina.'">';
	}
	
	function converteData($data){
		if(strstr($data, "/")){
			$data = explode('/', $data);
			$dataNova = $data[2].'-'.$data[1].'-'.$data[0];
		}
		 else if(strstr($data, "-")){
			$data = explode('-', $data);
			$dataNova = $data[2].'/'.$data[1].'/'.$data[0];
		}
		return $dataNova;
    }
	
	function validaEmail($email) {
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			return false;
		else
			return true;
	}
	
	function nomeRandomico() {
        $novoNome = "";
        for($i=0; $i<10; $i++) {
            $novoNome .= MD5(rand(0,9));
        }
        $novoNome = md5(md5($novoNome).md5(rand(0,9)));
		$novoNome = substr($novoNome, rand(0,24), 8);;
        return $novoNome;
    }
	
	function enviarEmail($destinatario, $nomeUsuario, $titulo, $msg){
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Port = 587;
		$mail->Host = 'smtp.sapo.pt';
		$mail->Username = 'tiago-franca@sapo.pt';
		$mail->Password = 'dkmgt01cs';

		$mail->CharSet = 'UTF-8';
		$mail->SetFrom('tiago-franca@sapo.pt', 'Não responda!'); 
		$mail->Subject  = $titulo;
		$mail->AddAddress($destinatario, $nomeUsuario); 
		$mail->MsgHTML($msg);
		
		if($mail->Send())
			return true;
		else
			return false;
	}
?>
