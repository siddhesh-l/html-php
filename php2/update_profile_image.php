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

// Handle profile image upload
if ($_SERVER['REQUEST_METHOD'] == "POST") {
   if (!empty($_FILES['new_profile_image']['name'])) {
      $target_dir = "img/";
      $target_file = $target_dir . basename($_FILES['new_profile_image']['name']);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      // Check if the uploaded file is an image
      $check = getimagesize($_FILES['new_profile_image']['tmp_name']);

      if ($check !== false) {
         $allowed_extensions = array("jpg", "png", "jpeg");

         if (in_array($imageFileType, $allowed_extensions)) {
            if (move_uploaded_file($_FILES['new_profile_image']['tmp_name'], $target_file)) {
               // Update the user's profile image in the database
               $new_image = mysqli_real_escape_string($conn, $target_file);
               $update_sql = "UPDATE users SET user_image = '$new_image' WHERE id = $user_id";

               if (mysqli_query($conn, $update_sql)) {
                  $_SESSION['user_image'] = $new_image;
                  $_SESSION['success_message'] = "Profile image updated successfully";
                  header('location:profilepage.php');
               } else {
                  $_SESSION['error_message'] = "Error updating profile image: " . mysqli_error($conn);
               }
            } else {
               echo "Error uploading the image.";
            }
         } else {
            echo "Invalid file format. Allowed formats: JPG, PNG, JPEG";
         }
      } else {
         echo "The uploaded file is not an image.";
      }
   } else {
      echo "No new image uploaded.";
   }
}

// Close the database connection
mysqli_close($conn);
