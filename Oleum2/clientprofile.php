
<?php
require_once("connection.php");

session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: Login_Member.php');
    exit;
}

$member_id = $_SESSION['id'];

// Fetch member data from the database
$stmt = $conn->prepare("SELECT * FROM member WHERE member_ID = ?");
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Error: member with ID $member_id does not exist";
    exit;
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $address_1 = $_POST['address_1'];
    $address_2 = $_POST['address_2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];

    // Validate form data
    $errors = array();
    if (empty($full_name)) {
        $errors[] = "Full Name is required.";
    }
    if (empty($address_1)) {
        $errors[] = "Address Line 1 is required.";
    }
    if (empty($city)) {
        $errors[] = "City is required.";
    }
    if (empty($state)) {
        $errors[] = "State is required.";
    }

    if (empty($errors)) {
        // Check if client profile already exists for this member
        $stmt_check = $conn->prepare("SELECT * FROM clientprofile WHERE member_ID = ?");
        $stmt_check->bind_param("i", $member_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Update existing client profile
            $stmt_update = $conn->prepare("UPDATE clientprofile SET full_name = ?, address_1 = ?, address_2 = ?, city = ?, state = ?, zipcode = ? WHERE member_ID = ?");
            $stmt_update->bind_param("ssssssi", $full_name, $address_1, $address_2, $city, $state, $zipcode, $member_id);

            if ($stmt_update->execute()) {
                echo "Client Profile updated successfully!";
            } else {
                echo "Error updating Client Profile: " . $conn->error;
            }
        } else {
            // Insert new client profile
            $stmt_insert = $conn->prepare("INSERT INTO clientprofile (member_ID, full_name, address_1, address_2, city, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt_insert->bind_param("isssssi", $member_id, $full_name, $address_1, $address_2, $city, $state, $zipcode);

            if ($stmt_insert->execute()) {
                echo "Client Profile assigned successfully!";
            } else {
                echo "Error assigning Client Profile: " . $conn->error;
            }
        }
    } else {
        // Display errors to the user
        echo "<ul>";
       
