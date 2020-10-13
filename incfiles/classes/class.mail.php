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

require_once '../incfiles/classes/class.helpers.php';

try {
  class BUKUANE_MAILER {
    private $mail;

    public function __construct() {
      $this->mail = new PHPMailer(true);
    }

    public function send_to($to, $subject, $message = '', $name = '') {
      global $helper;

      // Server settings
      $this->mail->SMTPDebug  = $helper->setOf('site_smtpDebug');
      $this->mail->isSMTP();
      $this->mail->Host       = $helper->setOf('site_smtpHost');
      $this->mail->SMTPAuth   = $helper->setOf('site_smtpAuth');
      $this->mail->Username   = $helper->setOf('site_smtpUser');
      $this->mail->Password   = $helper->setOf('site_smtpPassword');
      $this->mail->SMTPSecure = $helper->setOf('site_smtpSecure');
      $this->mail->Port       = $helper->setOf('site_smtpPort');

      //Recipients
      $this->mail->setFrom($helper->setOf('site_smtpFrom'), $helper->setOf('site_situs'));
      $this->mail->addAddress($to, $name);
      $this->mail->addReplyTo($helper->setOf('site_smtpFrom'), $helper->setOf('site_situs'));
      $this->mail->addCC($helper->setOf('site_smtpFrom'), $helper->setOf('site_situs'));
      $this->mail->addBCC($helper->setOf('site_smtpFrom'), $helper->setOf('site_situs'));

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