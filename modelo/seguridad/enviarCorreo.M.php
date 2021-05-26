<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'correo/Exception.php';
require 'correo/PHPMailer.php';
require 'correo/SMTP.php';

class enviarCorreo
{
    private $correo;

    //correo
    public function getCorreo()
    {
        return $this->correo;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    //conexion
    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function __destruct()
    {
        unset($this->correo);
    }

    public function enviarCorreo()
    {
        $respuesta = array();

        try {
            //code...//Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );
            //Server settings
            $mail->SMTPDebug = 0; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'videoqualityasessment@gmail.com'; //SMTP username
            $mail->Password = 'W;Q~FzjHqsykIV2ygt\I'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // $mail->Port = 465; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('videoqualityasessment@gmail.com', 'Video Quality Asessment');
            $mail->addAddress('edurado.andres@gmail.com', 'Eduardo'); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Nueva evaluacion subjetiva enviada de direccion IP:'.$ip.'.';
            $mail->Body = '
            <h2>Formulario de evaluacion de calidad de video</h2></br></br>
            <h3><b>Direccion de IP de evaluacion: </b>'.$ip.'</h3></br></br>
            <h3><b>'.$secuencia1.': </b>'.$nombre1.'</h3></br>
            <h3><b>Puntaje: </b>'.$valor1.'</h3><hr></br></br>
            <h3><b>'.$secuencia2.': </b>'.$nombre2.'</h3></br>
            <h3><b>Puntaje: </b>'.$valor2.'</h3><hr></br></br>
            <h3><b>'.$secuencia3.': </b>'.$nombre3.'</h3></br>
            <h3><b>Puntaje: </b>'.$valor3.'</h3><hr></br></br>
            <h3><b>'.$secuencia4.': </b>'.$nombre4.'</h3></br>
            <h3><b>Puntaje: </b>'.$valor4.'</h3><hr></br></br>
            <h3><b>'.$secuencia5.': </b>'.$nombre5.'</h3></br>
            <h3><b>Puntaje: </b>'.$valor5.'</h3><hr></br></br>
            ';

            $mail->send();

            $respuesta['respuesta'] = "Los datos fueron enviados correctamente";
        } catch (Exception $e) {
            $respuesta['respuesta'] = "Error, los datos no se pudieron enviar. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>