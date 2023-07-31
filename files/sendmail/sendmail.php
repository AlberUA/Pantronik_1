<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/

	//Від кого лист
	$mail->setFrom('from@gmail.com', 'Pantronik. New order a call'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('marketing2804@ukr.net'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'New Order a Call';

	//Тіло листа
	$body = '<h1>Information:</h1>';

	if(trim(!empty($_POST['name']))){
      $body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
   };
	if(trim(!empty($_POST['phone']))){
      $body.='<p><strong>Phone:</strong> '.$_POST['phone'].'</p>';
   };
	if(trim(!empty($_POST['number']))){
      $body.='<p><strong>Number:</strong> '.$_POST['number'].'</p>';
   };
	if(trim(!empty($_POST['email']))){
      $body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
   };
	if(trim(!empty($_POST['message']))){
      $body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
   };
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Помилка';
	} else {
		// $message = 'Дані надіслані!';
      // header('location: https://brew.bet/index.html#popup_ok');
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>