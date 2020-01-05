<?php 
require("bootstrap.php");
require("class/MailTemplate.php");
// 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// 
$message = "";
// 
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    // 
    $mail = new PHPMailer(true);
    // 
    $senderName = $_POST['name'];
    $senderEmail = $_POST['email'];
    $messageFromSender = $_POST['message'];
    // 
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = True;                                   // Enable SMTP authentication
        $mail->Username   = 'eugene.sinamban@gmail.com';                     // SMTP username
        $mail->Password   = 'ofbdfotodunvknxt';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom($senderEmail, $senderName);
        $mail->addAddress('eugene.sinamban@gmail.com');     // Add a recipient
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Comment received on YogiExchange";
        $mail->Body    = MailTemplate::generate($messageFromSender, $senderName);
        $mail->AltBody = $messageFromSender;
    
        $mail->send();
        $message = 'Message has been sent';
        // 
    } catch (Exception $e) {
        // 
        $_SESSION['message'] = $mail->ErrorInfo;
        header("location:contact2.php?error=on");
    }
}
// 
$viewVars = [
    // 
    "url" => basename($_SERVER['PHP_SELF']),
    "message" => $message,
    'error' => isset($_GET['error']) && 'on' === $_GET['error'] ? $_SESSION['message'] : null
];
// 
echo $twig->render('contact.twig', $viewVars);
?>