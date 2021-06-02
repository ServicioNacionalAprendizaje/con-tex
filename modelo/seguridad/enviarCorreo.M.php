<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'correo/Exception.php';
require 'correo/PHPMailer.php';
require 'correo/SMTP.php';

class enviarCorreo
{
    private $correo;
    private $contrasenia;

    //correo
    public function getCorreo()
    {
        return $this->correo;
    }
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }
    //nueva contraseña
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    //conexion
    public function __construct()
    {
        $this->conn = new Conexion();
    }

    public function __destruct()
    {
        unset($this->correo);
        unset($this->contrasenia);
    }

    public function EnviarCorreo()
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
            $mail->Username = 'noreplay.contex@gmail.com'; //SMTP username
            $mail->Password = '%y1Ix;7tJ5;2R?9Ip$8e'; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // $mail->Port = 465; //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('noreplay.contex@gmail.com', 'Aplicativo Con-Tex');
            $mail->addAddress($this->correo); //Add a recipient

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = utf8_decode('Actualización de contraseña');
            $mail->Body = 'Su nueva contraseña es '.$this->contrasenia;

            $mail->send();

            $respuesta['respuesta'] = "Los datos fueron enviados correctamente";
        } catch (Exception $e) {
            $respuesta['respuesta'] = "Error, los datos no se pudieron enviar. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>