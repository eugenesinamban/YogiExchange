<?php 
require("bootstrap.php");
require_once("class/Mail.php");
// 
$message = "";
// 
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    // 
    try {
        
        Mail::send($_POST);

        $message = "Comment successfully sent!";

    } catch (Exception $e) {
        // 
        $_SESSION['error'] = $mail->ErrorInfo;
        header("location:contact.php?error=on");
    }
}
// 
$viewVars = [
    // 
    "url" => basename($_SERVER['PHP_SELF']),
    "message" => $message,
    'error' => isset($_GET['error']) && 'on' === $_GET['error'] ? $_SESSION['error'] : null
];
// 
echo $twig->render('contact.twig', $viewVars);
?>