<?php

$server = 'localhost';
$username = 'root';
$password = "";
$database = 'ejemplo';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('ERROR: ' . $e->getMessage());
} 

?> 