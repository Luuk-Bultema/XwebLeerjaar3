<?php

$host = "localhost";
$dbnaam = "xweb";
$gebruiker = "root";
$ww = "";

$conn = new PDO("mysql:host=$host;dbname=$dbnaam;",
$gebruiker, $ww);

?>