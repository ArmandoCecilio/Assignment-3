<?php

// We need to use sessions, so we should start sessions using 'session_start()'
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Oleum</title>

    <link rel="stylesheet" href="Home_Page.css">


  </head>
  <body>
        <?php require_once('nav.php');?>  
        
        <div class="content">
            <?php if (isset($_SESSION['loggedin'])) { 
	                echo "<p style='margin-left:530px !important; color:#fff; z-index:2'>Welcome back, " . $_SESSION['name'] . "</p>"; 
                } else {
                  echo "<p style='margin-left:550px !important; color:#fff; z-index:2'>Welcome, Guest!</p>";
                } ?>
		</div>
        
    </body>

  <body>
    <section class="blue">
      <h1 style="margin-top:-10px">Oleum</h1>
      <p>A Oil web app designed for you.</p>
      <div class="blob"></div>
      
    </section>
        

    <head>
        <title>Oleum - Home</title>
        <link rel="stylesheet" href="test.css">
        <link rel="shortcut icon" type="image/x-icon" href="tab.ico" />
    </head>
    

  </body>
</html>
