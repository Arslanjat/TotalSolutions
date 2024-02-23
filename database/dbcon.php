<?php
$server = "mysql:host=localhost;dbname=totalsolutionspk";
$user = "root";
$password = "";

try {
    $pdo = new PDO($server, $user, $password);
    echo "<script>console.log('Connected');</script>";
} catch (PDOException $e) {
    echo "<script>console.error('Connection failed: " . $e->getMessage() . "');</script>";
}
?>
