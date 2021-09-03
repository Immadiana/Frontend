<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['lastname']) && isset($_POST['subject']) && isset($_POST['body'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "immasoftdev@gmail.com";
        $mail->Password = '0785355614';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email);
        $mail->addAddress($mail->Username);
        $mail->Subject = $subject;
        $mail->Body = $body."Please contact me back at"."\r\n".$firstname." ".$lastname."\r\n".$email;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
            
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        exit(json_encode(array("status" => $status, "response" => $response)));
    }
?>
