<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

//var_dump($_POST);
require "PHPMailer/src/SMTP.php";
require "PHPMailer/src/Exception.php";
require 'PHPMailer/src/PHPMailer.php';         // https://github.com/PHPMailer/PHPMailer

	
//Variáveis
 
$nome = $_POST['nome'];
$email = $_POST['email'];
//$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
//$anexo = $_POST['anexo'];
$mensagem = $_POST['mensagem-corpo'];
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

	$mail = new PHPMailer\PHPMailer\PHPMailer();
	$mail->setLanguage('br');                             // Habilita as saídas de erro em Português
	$mail->CharSet='UTF-8';                               // Habilita o envio do email como 'UTF-8'

	//$mail->SMTPDebug = 3;                               // Habilita a saída do tipo "verbose"

	$mail->isSMTP();                                      // Configura o disparo como SMTP
	$mail->Host = 'smtp.csiengenharia.com';                        // Especifica o enderço do servidor SMTP da Locaweb
	$mail->SMTPAuth = true;                               // Habilita a autenticação SMTP
	$mail->Username = 'contato@csiengenharia.com';                        // Usuário do SMTP
	$mail->Password = 'Csi#0011';                          // Senha do SMTP
	//$mail->SMTPSecure = 'ssl';                            // Habilita criptografia TLS | 'ssl' também é possível
	$mail->Port = 587;                                    // Porta TCP para a conexão
	$mail->SMTPAutoTLS =false;
	$mail->AuthType = 'PLAIN';
	//$mail->SMTPSecure = 'ssl';                            // Habilita criptografia TLS | 'ssl' também é possível
	

	$mail->From = 'contato@csiengenharia.com';                          // Endereço previamente verificado no painel do SMTP
	$mail->FromName = 'contato site';                     // Nome no remetente
	$mail->addAddress('csi@csiengenharia.com', $nome);// Acrescente um destinatário
	#$mail->addAddress('joao@exemplo.com');                // O nome é opcional
	#$mail->addReplyTo('info@exemplo.com', 'Informação');
	$mail->addCC('contato@csiengenharia.com');
	#$mail->addBCC('bcc@exemplo.com');
	$mail->isHTML(true);                                  // Configura o formato do email como HTML

	$mail->Subject = 'Solicitação de Contato';
	$mail->Body    = ($mensagem . $nome . $email . $cep);
	//$mail->AltBody = 'Esse é o corpo da mensagem em formato "plain text" para clientes de email não-HTML';

	if(!$mail->send()) {
		 echo 'A mensagem não pode ser enviada, tente novamente ou contate pelo fone
		 65-9-8118-3965 ' . "<br>";
		 echo 'Mensagem de erro: ' . $mail->ErrorInfo;
	} else {
		 echo 'Mensagem enviada com sucesso';
		//header('Location: /index.html');
	}



