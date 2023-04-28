<?php
    require_once("connection.php");
    /*$dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "Decon_0213";
    $dbName = "mydb";
    */
    
    $connMember = $conn;//mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
    if (!$connMember) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!isset($_POST['password'], $_POST['username'])) {
        exit('Please complete the registration form!');
    }
    if ( empty($_POST['password'])  || empty($_POST['username'])) {
        exit('Please complete the registration form');
    }

    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
        exit('Username is not valid!');
    }
    if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
        exit('Password must be between 5 and 20 characters long!');
    }
 
    if ($stmt = $connMember->prepare('SELECT member_ID, password FROM member WHERE username = ?')) {
	    $stmt->bind_param('s', $_POST['username']);
	    $stmt->execute();
	    $stmt->store_result();
	    if ($stmt->num_rows > 0) {
		    echo 'Username exists, please choose another!';
	    } else {	
            if ($stmt = $connMember->prepare('INSERT INTO member(password, username) VALUES (?, ?)')) {
	            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	            $stmt->bind_param('ss', $password, $_POST['username']);
	            $stmt->execute();
	            
                header('Location: Login_Member.php?accountCreation=success');
            } else {
	            echo 'Could not prepare statement!';
            }
	    } 
	    $stmt->close();
    } else {
	    echo 'Could not prepare statement!';
}
$connMember->close();
?>
