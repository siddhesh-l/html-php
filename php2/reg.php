<?php 

include "db_helper.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
   $name = $_POST["name"];
   $email = $_POST["email"];
   $password = $_POST["password"];
   $phone = $_POST["phone"];
   $gender = $_POST["gender"];
   $usertype = $_POST["usertype"];

   // echo $name, "\n", $email, "\n", $password, "\n", $phone, "\n", $gender, "\n", $usertype;

   $alertclass = "";

   if(empty($name) || empty($email) || empty($password) || empty($phone) || empty($gender) || empty($usertype)){
      
      $alertclass = "alert-danger";
      $message = "All Field are required.";

   }else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
   {
      
      $alertclass = "alert-danger";
      $message = "Enter valid email";

   }
   else if(!strlen($password) < 8)
   {
      
      $alertclass = "alert-warning";
      $message = "Password should be at least 8 character long";

   }
   else if($usertype !== "user" && $usertype !== "admin")
   {
      
      $alertclass = "alert-warning";
      $message = "invalid user type selected";

   }
   else
   {
      $sql = "INSERT INTO `users`(`id`, `username`, `email`, `password`, `phone`, `gender`, `usertype`)
      VALUES ('$name', '$email', '$password', '$phone', '$gender', '$usertype')";

      if ($conn->query($sql) === TRUE) 
      {
         $alertclass = "alert-success";
         $message = "Registration successful.";
      } 
      else 
      {
         $alertclass = "alert-danger";
         $message = "Error: " . $sql . "<br>" . $conn->error;
      }
   }
}

$conn->close();

?>





<!--

   
?> -->
<!-- <div class="alert alert-dismissible <?php echo $alertclass; ?>" role="alert">
                        <?php echo $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div> -->