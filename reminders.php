<?php 
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'maps';
    $db_dsn = "mysql:dbname=$dbname;host=$dbhost";
    try {
      $conn = new PDO($db_dsn, $dbuser, $dbpass);
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require '../vendor/autoload.php';

    $id_users = 14;
    $get_data = "SELECT form_promotion.promotion_id,form_promotion.promotion_number FROM form_promotion LEFT JOIN wf_program ON form_promotion.promotion_number = wf_program.promotion_number AND form_promotion.approval_scheme = wf_program.approval_scheme WHERE wf_program.id_users = $id_users AND wf_program.approve_by IS NULL AND wf_program.reject_by IS NULL";

    $get_email = "SELECT email, full_name From tbl_user WHERE id_users = $id_users";

    $data = $conn->query($get_email);
    foreach ($conn->query($get_data) as $row) {
        $promotion_id = $row['promotion_id'];
        $promotion_number = $row['promotion_number'];
    }

    $message = '<div><p>Yth. Bapak/Ibu ' . $data['full_name'] . ',<br/>
    <br/>Mohon cek <b>Request Promotion</b> yang masih menunggu approve Bapak/Ibu ' . $data['full_name'] . ', berikut list nya :</p>
    </div>
    <table border="1" bordercolor="#333333">
    <thead>
    <tr>
        <td colspan="2" align="center" bgcolor="#3C8DBC"><b><font color="#FFFFFF">LIST PROMOTION FORM</font></b></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td style="padding-left:20px; padding-right:20px;">Promotion NUmber</td>
        <td style="padding-left:20px; padding-right:20px;">';
    foreach ($conn->query($get_data) as $data) {
    $message .= '<p><a href="http://maps.mustika-ratu.com/wf_program/read/' . $data['promotion_id'] . '">' . $data['promotion_number'] . '</a></p><br/>';
    }
    $message .= '</td></tr></tbody></table>';

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;
    $mail->Username = 'mustikaratu.mailer@gmail.com';
    $mail->Password = 'MustikaGoogle@MR2022';
    $mail->setFrom('mustikaratu.mailer@gmail.com', 'MAPS');
    $mail->addBCC('development@mustika-ratu.co.id', 'IT Development');
    $mail->addAddress($data['email']);
    $mail->Subject = 'Reminders Approval Pending';
    $mail->msgHTML($message, __DIR__);
    $mail->AltBody = 'This is a plain-text message body';

    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }

    function save_mail($mail)
    {
        $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
        $imapStream = imap_open($path, $mail->Username, $mail->Password);
        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);
        return $result;
    }
?>