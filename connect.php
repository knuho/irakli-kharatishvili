<?php

$connect = mysqli_connect("localhost","root","", "scsa");
$connect->set_charset("utf-8");

if(!$connect) {
echo ("Could not connect to the database.");
exit();
}
?>