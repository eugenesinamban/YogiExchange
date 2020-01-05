<?php
session_start();
require("class/Exchange.php");
require("class/Rates.php"); 
require("bootstrap.php");
date_default_timezone_set("asia/tokyo");
$template = $twig->load("index.twig");
$output = new Output();
// 
if (isset($_GET['error']) && 'on' === $_GET['error']) {
    // 
    $message = $_SESSION['message'];
    // 
} else {
    $message = [
        // 
        'message' => "Please enter amount",
        'class' => Null
    ];
}
// 
try {
    // 
    // 
    if (false === Rates::isValid()) {
        // 
        Rates::cacheRates();
    }
    // 
    if ("POST" == $_SERVER['REQUEST_METHOD']) {
        // 
        $message = [
            // 
            'message' => Exchange::compute($_POST),
            'class' => "is-success"
        ];
    }
    // 
} catch (Exception $e) {
    // 
    $_SESSION['message'] = [
        // 
        'message' => $e->getMessage(),
        'class' => "is-danger"
    ];
    // 
    header("location:index2.php?error=on");
    // 
} finally {
    // 
    $viewVars = [
        // 
        'url' => basename($_SERVER['PHP_SELF']),
        'filetime' => date("Y-m-j h:i" ,filemtime("rates.json")),
        'output' => $output,
        'message' => $message,
        'post' => [
            // 
            'currency1' => isset($_POST['currency1']) && "" !== $_POST['currency1'] ? $_POST['currency1'] : null,
            'currency2' => isset($_POST['currency2']) && "" !== $_POST['currency2'] ? $_POST['currency2'] : null,
            'amount' => isset($_POST['amount']) && "" !== $_POST['amount'] ? $_POST['amount'] : null
        ]
    ];
    // 
    echo $template->render($viewVars);
    // 
}
?>