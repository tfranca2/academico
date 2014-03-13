<?php
	require_once('PHPMailer_5.2.4/class.phpmailer.php');

	function enviarEmail($destinatario, $nomeUsuario, $msg){
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = 'true';
		$mail->Port = 587;
		$mail->Host = 'smtp.sapo.pt';
		$mail->Username = 'tiago-franca@sapo.pt';
		$mail->Password = 'dkmgt01cs';

		$mail->SetFrom('tiago-franca@sapo.pt', 'N&atilde;o responda! - Sua nova senha do sistema.'); 
		$mail->AddAddress($destinatario, $nomeUsuario); 
		$mail->MsgHTML($msg);
		
		if($mail->Send())
			return true;
		else
			return false;
	}
?>