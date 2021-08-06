<?php
    include 'includes/dbconnect.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    session_start();
    if(isset($_POST['contact'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $content = 'NAME : ' . $fname . ' ' . $lname . '<br>';
        $contact = $contact . 'EMAIL : ' . $email . '<br>';
        $contact = $contact . 'CONTACT : ' . $contact . '<br>';
        $contact = $contact . 'SUBJECT : ' . $subject . '<br>';
        $contact = $contact . 'MESSAGE : <br> ' . $message . '<br>';

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'a4rbookstore@gmail.com';
            $mail->Password   = 'a4rbookstore';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
        
            //Recipients
            $mail->setFrom('a4rbookstore@gmail.com', 'A4R BookStore');
            $mail->addAddress($email);
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $contact;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/3a522aa8ba.js" crossorigin="anonymous"></script>
    <title>A4R BookStore</title>
</head>
<body>
    <?php include 'includes/header.php' ?>
    <div class="container contact-container">
        <div class="contact-form">
            <form action="" method="post">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="fname">First Name <span style="color:red">*</span></label>
                        <input type="text" name="fname" id="fname" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lname">Last Name <span style="color:red">*</span></label>
                        <input type="text" name="lname" id="lname" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="email">Email <span style="color:red">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="number">Contact <span style="color:red">*</span></label>
                        <input type="number" name="number" id="number" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Subject <span style="color:red">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="number">Message <span style="color:red">*</span></label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <center>
                    <button class="btn btn-success" name="contact">Sumbit</button>
                </center>
            </form>
        </div>
    </div>
    <?php include 'includes/footer.php' ?>
</body>
</html>

<style>
    .contact-container {
        padding: 50px;
        min-height: calc(100vh - 150px);
    }
    .contact-form {
        width: 80%;
        margin: auto;
    }
</style>