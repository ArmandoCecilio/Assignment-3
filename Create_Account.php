<?php
session_start();

function createAccount($username, $password, $existingUsers) {
    foreach ($existingUsers as $user) {
        if ($user['username'] === $username) {
            return false;
        }
    }

    $newUser = array('username' => $username, 'password' => $password);
    array_push($existingUsers, $newUser);

    return true;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // perform validation
    if(empty($username) || empty($password)) {
        header("Location: create-account.php?error=1");
        exit();
    }

    // check if user already exists
    $existingUsers = array(
        array('username' => 'user1', 'password' => 'pass1'),
        array('username' => 'user2', 'password' => 'pass2'),
        array('username' => 'user3', 'password' => 'pass3')
    );

    $result = createAccount($username, $password, $existingUsers);

    if($result){
        // create session
        $_SESSION['username'] = $username;
        header("Location: ClientProfile.html");
        exit();
    } else {
        header("Location: Create_Account.php?error=2");
        exit();
    }
}
?>