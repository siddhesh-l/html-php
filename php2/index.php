<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
   <title>Document</title>
   <style>
      .gradient-background {
         background: linear-gradient(135deg, #d9ffbd, #9effdf, #fdbdff,#cfc2ff);
         height: 723px;
      }
      .card-shadow{
         box-shadow: 5 10px 10px rgba(0, 0, 0, 0.1);
      }
      .error{
         color: red;
      }
      
   </style>

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body class="gradient-background">
<?php

use LDAP\Result;

error_reporting(0);

include "db_helper.php";

$name = $email = $password = $mobile = $gender = $usertype = "";
$registration_date = date('d-m-y:H:i:s');



// Retrieve and sanitize user input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $mobile = test_input($_POST["phone"]);
    $gender = test_input($_POST["gender"]);
    $usertype = test_input($_POST["usertype"]);

    // Validate each field (Test Cases)
    $name_error = validate_name($name);
    $email_error = validate_email($email);
    $email_error = check_email($conn, $email);
    $password_error = validate_password($password);
    $hashed_password = hash('sha256', $password);
    $mobile_error = validate_mobile($mobile);
    
    if (empty($name_error) && empty($email_error) && empty($password_error) && empty($mobile_error)) {
      
         $default_image_path = "default_profile.png";
         $image_path = $default_image_path;
      

        // SQL query to insert data into the database
        $sql = "INSERT INTO `users`(`user_image`, `username`, `email`, `password`, `phone`, `gender`, `usertype`, `date`)
                VALUES ('$image_path','$name', '$email', '$hashed_password', '$mobile', '$gender', '$usertype','$registration_date')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            header('location:http://localhost/siddhesh/php2/login.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}

// Function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to validate Name
function validate_name($name) {
    if (empty($name)) {
        return "Name is required.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        return "Only letters and white space allowed in Name.";
    }
    return "";
}

// Function to validate Email
function validate_email($email) {
    if (empty($email)) {
        return "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
    
    return "";
}

// Function to validate Password
function validate_password($password) {
    if (empty($password)) {
        return "Password is required.";
    } elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
        return "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long.";
    }
    return "";
}

// Function to validate Mobile
function validate_mobile($mobile) {
    if (empty($mobile)) {
        return "Mobile is required.";
    } elseif (!preg_match("/^\d{10}$/", $mobile)) {
        return "Invalid mobile number format (10 digits required).";
    }
    return "";
}

function check_email($conn,$email){
   $query = "SELECT email FROM users WHERE email='$email'";
   $result = $conn -> query($query);
   if($result -> num_rows > 0){
      return "<span style='color:red'> This email is already exists </span>";
   }
   return "";
}
?>
   <div class="container ">
         <div class="row justify-content-center">
            <div class="col-md-4 p-4 mr-6">
               <div class="card h-56 card-shadow" style="width:25rem;">
                  <div class="card-body">
                     <h3 class="text-center mb-4">Registration Form</h3>
                     
                     <form method="post" action="index.php">
                        <div class="form-floating mb-3">
                           <input type="text" class="form-control" id="flotingName" name="name" placeholder="Name">
                           <label for="flotingName"><h6>Name</h6></label>
                           <span class="error"><?php echo $name_error; ?> </span>
                        </div>
                        <div class="form-floating mb-3">
                           <input type="email" class="form-control form-control-sm"  name="email" id="floatingEmail" placeholder="Email">
                              <label for="floatingEmail"><h6>Email address</h6></label>
                              <span class="error"><?php echo $email_error; ?> </span>
                        </div>
                        <div class="form-floating mb-3">
                           <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                           <label for="flotingPassword"><h6>Password</h6></label>
                           <span class="error"><?php echo $password_error; ?></span>
                        </div>
                        <div class="form-floating mb-3">
                           <input type="number" class="form-control" id="floatingPhone" name="phone" placeholder="Phone Number">
                           <label for="floatingPhone"><h6>Phone Number</h6></label>
                           <span class="error"><?php $mobile_error; ?></span>
                        </div>
                        <div class="mb-3">
                           <label for="gender" class="mb-2"><h6>Gender</h6></label><br>
                           <input type="radio" name="gender" id="male" value="male">
                           <label for="male">Male</label>
      
                           <input type="radio" name="gender" id="female" value="female">
                           <label for="female">Female</label>
                        </div>
      
                        <div class="mb-3">
                           <label for="user" class="mb-2"><h6>User Type</h6></label><br>
                           <input type="radio" name="usertype" id="user" value="user">
                           <label for="user">User</label>
                           <input type="radio" name="usertype" id="admin" value="admin">
                           <label for="admin">Admin</label>
                        </div>
      
                        <button type="submit" class="btn btn-primary w-100" value="submit" name="submit" id="submit">Register</button><br>
                        <p>Do not have any account? <a href="http://localhost/siddhesh/php2/login.php">Login</a></p>
                        
                     </form>
               </div>
               
            </div>
         </div>
      </div>
   </div>

</body>

</html>