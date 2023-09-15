<?php
session_start();

if (!isset($_SESSION['id'])) {
   header('location: login.php'); // Redirect if the user is not logged in
   exit();
}

$is_admin = ($_SESSION['usertype'] === 'admin');

if (!$is_admin) {
   header('location: unauthorized.php'); // Redirect if the user is not an admin (optional)
   exit();
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])) {
   // Get the user ID from the URL parameter
   $user_id = $_GET['id'];

   // Perform the delete operation (replace this with your actual delete code)
   include 'db_helper.php'; // Include your database connection code

   $sql = "DELETE FROM users WHERE id = $user_id";

   if (mysqli_query($conn, $sql)) {
      // Delete successful
      header('location: http://localhost/siddhesh/php2/home.php'); // Redirect back to the home page after deletion
      exit();
   } else {
      // Delete failed
      echo "Error deleting user: " . mysqli_error($conn);
   }
} else {
   // Invalid request
   header('location: invalid_request.php'); // Redirect if the request is invalid (optional)
   exit();
}
?>
