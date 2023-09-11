<?php 
error_reporting(0);
include 'backend/dbheler.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
   $name = $_POST["username"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $phone = $_POST["phone"];
   $gender = $_POST["gender"];
   $usertype = $_POST["usertype"];

   // echo $name; die;

   $alertclass = "";
   $user_password = $password;
   $pattern = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,}$/";

   if(empty($name) || empty($email) || empty($password) || empty($phone) || empty($gender) || empty($usertype))
   {
      $alertclass = "alert-danger";
      $message = "All Field are required.";
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
   {
      $alertclass = "alert-danger";
      $message = "Enter valid email";
   }
   else if(preg_match($pattern, $user_password))
   {
      $alertclass = "alert-warning";
      $message = "Please Enter Proper Password";
   }

   else if($usertype !== "user" && $usertype !== "admin")
   {
      $alertclass = "alert-warning";
      $message = "invalid user type selected";
   }
   else
   {
      if($email === "siddhesh@gmail.com")
      {
         $message = "alert-info";
         $message = "Email already exists";
      }
      else
      {
         $message = "alert-successful";
         $message = "Registration Successful";
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
   <title>Document</title>
</head>
</body>
   <div class="container mt-5">
      <?php if(isset($message)): ?>
         <div class="alert <?php echo $alertclass; ?>">
         <?php echo $message; ?>
      </div>
      <?php endif;?>      
   </div>
</html>


