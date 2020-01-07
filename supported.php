<?php 
require("class/Output.php"); 
require("bootstrap.php");
date_default_timezone_set("asia/tokyo");
$template = $twig->load("supported.twig");
// 
$output = new Output();
// 
$viewVars = [
    // 
    'url' => basename($_SERVER['PHP_SELF']),
    'filetime' => date("Y-m-j h:i" ,filemtime("rates.json")),
    'output' => $output
];
// 
echo $template->render($viewVars);
?>