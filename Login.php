<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'oleum';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        header('Location: fuel_quote_form.html');
        exit;
    } else {
        echo 'Incorrect username or password. Please try again.';
    }
}

mysqli_close($conn);

