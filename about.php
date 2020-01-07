<?php 
require("bootstrap.php");
// 
$viewVars = [
    // 
    "url" => basename($_SERVER['PHP_SELF'])
];
// 
echo $twig->render('about.twig', $viewVars);
?>