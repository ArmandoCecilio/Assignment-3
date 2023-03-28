<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'temp1' && $password === 'temp2') {
        header('Location: fuel_quote_form.php');
        exit;
    } else {
        echo 'Incorrect username or password. Please try again.';
    }
}
?>