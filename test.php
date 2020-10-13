<?php
  require_once 'incfiles/class.mail.php';
  $mailer->send_to('affin.cyber@gmail.com', 'Testing Email', 'Hanya test <b>HTML</b>', 'Afid Arifin');
  if($mailer->send_now()) {
    echo 'Email terkirim!';
  } else {
    echo 'Email gagal terkirim!';
  }
?>
