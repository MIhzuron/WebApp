<?php
 
$host="localhost";
$user="eavnicom_eavni";
$pass="jePuc-*qO9";
$db="eavnicom_sadna";

$conn=new mysqli($host,$user,$pass,$db);
$conn->set_charset("utf8");
if ($conn->connect_error){
die("Connection failed: ".$conn->connect_error);}


?>
