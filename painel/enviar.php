<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

// carregando o php mailer instalado pelo composer


// pegando os dados do formulario
$nome = $_POST['nome'];
$email = $_POST['email'];
$destinatario = $_POST['destinatario'];
$mensagem = $_POST['mensagem'];

// validando o email de quem enviou
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('o E-mail informado nao é valido');
}

// validando o email do destinatario
if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
    exit('o E-mail do destinatario é invalido');
}

$mail = new PHPMailer(true);

try {

    // configurando o SMTP

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;

    $mail->Username = 'maiquel.correa12@gmail.com';

    $mail->Password = 'lkcc eekp ahic rgzb';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;

    // remetente
    $mail->setFrom(
        'maiquel.correa12@gmail.com',
        'Mensagem recebida do site do meiquel(eu kkkkk) de teste'
    );

    // destinatario
    $mail->addAddress(
        $destinatario
    );

    // conteudo do email
    $mail->isHTML(true);

    $mail->Subject = 'Nova mensagem do site';

    $mail->Body = "
        <h2>Nova mensagem recebida!</h2>

        <p>
            <strong>Nome:</strong>
            {$nome}
        </p>

        <p>
            <strong>Email:</strong>
            {$email}
        </p>

        <p>
            <strong>Mensagem:</strong>
            {$mensagem}
        </p>
    ";

    // Envia o email

    $mail->send();

    header('location: ./index.php');
    exit;
} catch (Exception $e) {
    echo 'erro ao enviar ';
}

// senha: lkcc eekp ahic rgzb 
