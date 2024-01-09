<?php
$host = "153.92.15.1";
$username = "u756153907_root";
$password = "Superman#1234";
$dbname = "u756153907_hotaru";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
?>