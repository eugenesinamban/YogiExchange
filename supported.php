<?php 
require("class/Output.php"); 
require("class/Rates.php");
require("bootstrap.php");
date_default_timezone_set("asia/tokyo");
$template = $twig->load("supported.twig");
// 
$output = new Output();
$rates = new Rates();
// 
$viewVars = [
    // 
    'url' => basename($_SERVER['PHP_SELF']),
    'filetime' => date("Y-m-j h:i" ,filemtime("rates.json")),
    'output' => $output,
    'rates' => $rates
    
];
// 
echo $template->render($viewVars);
?>