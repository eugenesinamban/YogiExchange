<?php
session_start();
require("class/Exchange.php");
require("bootstrap.php");
date_default_timezone_set("asia/tokyo");
try {
    // 
    if (false === Rates::isValid()) {
        // 
        Rates::cacheRates();
    }
    // 
    $output = new Output();
    $error = $_SESSION['error'] ?? null;
    $url = basename($_SERVER['PHP_SELF']);
    $message = ("POST" == $_SERVER['REQUEST_METHOD']) ? ['message' => Exchange::compute($_POST), 'class' => "is-success"] : ['message' => "Please enter amount"];
    // 
    $viewVars = [
        // 
        'url' => $url,
        'filetime' => date("Y-m-j h:i" ,filemtime("rates.json")),
        'output' => $output,
        'message' => $message,
        'error' => $error,
    ];
    // 
    // 
} catch (Exception $e) {
    // 
    $_SESSION['error'] = $e->getMessage();
    // 
    header("location:index.php?error=on");
    // 
} 
echo $twig->render('index.twig', $viewVars);
$_SESSION['error'] = '';
?>