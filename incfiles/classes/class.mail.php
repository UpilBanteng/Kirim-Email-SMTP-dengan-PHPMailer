<?php
/**
 * @Package     BUKUANE - Marketplace Penjualan BUKU
 * @Version     v1.0.0
 * @Author      https://nuliskode.com
 * @Created on  29 September 2020
 */
ini_set('display_errors', 0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../incfiles/mailer/src/PHPMailer.php';
require_once '../incfiles/mailer/src/Exception.php';
require_once '../incfiles/mailer/src/OAuth.php';
require_once '../incfiles/mailer/src/POP3.php';
require_once '../incfiles/mailer/src/SMTP.php';

try {
  class BUKUANE_MAILER {
    private $mail;

    public function __construct() {
      $this->mail = new PHPMailer(true);
    }

    public function send_to($to, $subject, $message = '', $name = '') {
      global $helper;

      // Server settings
      $this->mail->SMTPDebug  = 0;
      $this->mail->isSMTP();
      $this->mail->Host       = 'tls://smtp.gmail.com';
      $this->mail->SMTPAuth   = true;
      $this->mail->Username   = 'email@anda.com;
      $this->mail->Password   = 'PasswordAnda';
      $this->mail->SMTPSecure = 'tls';
      $this->mail->Port       = 587;

      //Recipients
      $this->mail->setFrom('no-reply@nuliskode.com', 'nuliskode.com');
      $this->mail->addAddress($to, $name);
      $this->mail->addReplyTo('no-reply@nuliskode.com', 'nuliskode.com');
      $this->mail->addCC('no-reply@nuliskode.com', 'nuliskode.com');
      $this->mail->addBCC('no-reply@nuliskode.com', 'nuliskode.com');

      // Content
      $this->mail->isHTML(true);
      $this->mail->Subject  = $subject;
      $this->mail->Body     = $message;
      $this->mail->AltBody  = $message;
    }

    public function send_now() {
      if($this->mail->send()) {
        return true;
      } else {
        return false;
      }
    }
  }

  $mailer = new BUKUANE_MAILER();
} catch(Exception $e) {
  echo '<b>Mailer Error</b>: '.$e->getMessage().'; (<b>Trace</b>: '.$e->getCode().')';
  exit();
}
?>
