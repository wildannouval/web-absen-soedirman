<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'webabsensi';

$conn = mysqli_connect($host,$user,$pass,$db) or die ('Cant connect to database');
?>