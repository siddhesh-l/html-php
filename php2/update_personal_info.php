<?php
// Database connection and session start (include db_helper.php)
require_once 'db_helper.php';
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['id'])) {
   header("location: http://localhost/siddhesh/php2/login.php");
   exit;
}

// Get the user ID from the session
$user_id = $_SESSION['id'];

// Handle personal information update
if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
   $new_phone = mysqli_real_escape_string($conn, $_POST['new_phone']);
   $new_gender = mysqli_real_escape_string($conn, $_POST['new_gender']);

   // Update the user's personal information in the database
   $update_sql = "UPDATE users SET username = '$new_username', phone = '$new_phone', gender = '$new_gender' WHERE id = $user_id";

   if (mysqli_query($conn, $update_sql)) {
      $_SESSION['name'] = $new_username;
      $_SESSION['phone'] = $new_phone;
      $_SESSION['gender'] = $new_gender;
      $_SESSION['success_message'] = "Personal information updated successfully";
      header("location:http://localhost/siddhesh/php2/profilepage.php");
   } else {
      $_SESSION['error_message'] = "Error updating personal information: " . mysqli_error($conn);
   }
}

// Close the database connection
mysqli_close($conn);
