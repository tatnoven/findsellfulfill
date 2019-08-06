<?php
$servername = "localhost";
$username = "findsell_nadmin";
$password = "JVF@94%rS4z^";
$database = "findsell_newapp";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
