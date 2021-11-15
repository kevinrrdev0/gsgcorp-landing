<?php 		 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
function validar_campo($campo){
	$campo=trim($campo);
	$campo=stripcslashes($campo);
	$campo=htmlspecialchars($campo);

	return $campo;
} 
 

if (isset($_POST["name"]) && !empty($_POST["name"]) &&
	isset($_POST["email"]) && !empty($_POST["email"]) &&
	isset($_POST["message"]) && !empty($_POST["message"])) {
	# code...
	$nombre=validar_campo($_POST["name"]);		
	$correo=validar_campo($_POST["email"]);
	$mensaje=validar_campo($_POST["message"]);

	$contenido="Nombre: " .$nombre. "\nCorreo: ". $correo."\nMensaje: ".$mensaje;
	$result="";
	$mail = new PHPMailer(true);  // Passing `true` enables exceptions
	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'mail.gsgcorppe.com;mail.gsgcorppe.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'contacto.info@gsgcorppe.com';                 // SMTP username
	    $mail->Password = 'Ebz(c&=BOqLY';                           // SMTP password
	    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 465;                                    // TCP port to connect to

	    //Recipients
	    $mail->setFrom('contacto.info@gsgcorppe.com', 'Mailer'); 
	 	$mail->addAddress('ventas.info@gsgcorppe.com', 'Yahaira');     // Add a recipient
	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Contacto del cliente '.$nombre;
	    $mail->Body    = $contenido;
	    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    $data= array("rspta"=>'Correo enviado.');

 		echo json_encode($data); 
	} catch (Exception $e) {
		$data= array("rspta"=>'Correo no se pudo enviar.');
		//echo json_encode($data); 
	}	
	
} 

?>