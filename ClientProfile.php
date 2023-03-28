<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["fullName"]) || empty(trim($_POST["fullName"])) ||
        !isset($_POST["address1"]) || empty(trim($_POST["address1"])) ||
        !isset($_POST["city"]) || empty(trim($_POST["city"])) ||
        !isset($_POST["state"]) || empty(trim($_POST["state"])) ||
        !isset($_POST["zip"]) || empty(trim($_POST["zip"]))) {
        echo "Missing field";
    } else {
        $_SESSION["profile_completed"] = true;
        header("Location: fuel_quote_form.php");
        exit;
    }
}

$profile_completed = isset($_SESSION["profile_completed"]) && $_SESSION["profile_completed"];

if (!$profile_completed) {
    echo "Client Profile must be completed before accessing Fuel Quote Form.";
    exit;
}
?>