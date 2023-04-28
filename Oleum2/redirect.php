<?php
require_once("connection.php");
session_start();
$_POST=Array();

if(isset($_GET['success']))
{
    $id=$_GET['success'];
    header("Location: fuelquoteform.php?success=$id");
    exit();
}
else
{
    header("Location: home_page.php?");
    exit();
}
