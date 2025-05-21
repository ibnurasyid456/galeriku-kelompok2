<?php
$host="localhost";
$user="root";
$pass="";
$db="galeri_foto";

$con = mysqli_connect($host,$user,$pass,$db);

if(!$con){
    die("Error ".mysqli_connect_error());
}

?>