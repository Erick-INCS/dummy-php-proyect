<?php
$mail_conf = array(
    'smtp_host' => getenv('SMTP_HOST'),
    'addr' => getenv('ADDR'),
    'pass' => getenv('PASS'),
    'app_name' => getenv('APP_NAME'),
    'forced_recp' => getenv('FORCED_RECP'),
);
?>
