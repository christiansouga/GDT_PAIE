<?php 
$host = 'localhost';
$dbname = 'geppt';
$username = 'root';
$password = 'lechris2022';
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
