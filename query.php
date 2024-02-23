<?php
include('database/dbcon.php');

require 'folder/PHPMailer.php';
require 'folder/Exception.php';
require 'folder/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if (isset($_POST['btnsubmit'])) {
    $cname = $_POST['name'];
    $cemail = $_POST['email'];
    $csubject = $_POST['subject'];
    $cmessage = $_POST['message'];
    $query = $pdo->prepare("INSERT INTO users (`name`, `email`, `subject`, `message`) VALUES (:cname, :cemail, :csubject, :cmessage)");
    $query->bindParam(':cname',$cname);
    $query->bindParam(':cemail',$cemail);
    $query->bindParam(':csubject',$csubject);
    $query->bindParam(':cmessage',$cmessage);
    $query->execute();
    
    if ($query->execute()) {
        echo "<script>alert('message sent successfully');</script>";
        
    } else {
        echo "<script>alert('message couldn't be sent');</script>";
    }
    $recipientEmail = "craft0199@gmail.com"; 
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'craft0199@gmail.com'; 
        $mail->Password   = 'tycdemvbeopgnuib';   
        $mail->SMTPSecure = 'tls'; 
        $mail->Port       = 587; 
        $mail->setFrom($cemail, $cname);
        $mail->addAddress($recipientEmail);
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Total Solutions';
        $mail->Body    = "Name: $cname<br>Email: $cemail<br>Subject: $csubject<br>Message: $cmessage";
        $mail->send();
        
    } catch (Exception $e) {
        echo '<script type="text/javascript">console.log("Error sending email: ' . $mail->ErrorInfo .'");</script>';
    }

    echo "<script>
    setTimeout(function () {
        window.location.href = 'index.php'; 
    }, 1000);
  </script>";
}

?>