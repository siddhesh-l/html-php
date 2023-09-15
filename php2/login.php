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
      
   </style>

</head>

<body class="gradient-background">
<?php
// error_reporting(E_ERROR | E_WARNING);
session_start();

include "db_helper.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);

   //  echo $email; echo "<br>"; echo $password; die;

    $email_error = validate_email($email);
    $password_error = validate_password($password);
    $hashed_password = hash('sha256', $password);
   //  echo $hashed_password; die; 

    if (!empty($email_error)) {
        $errors['email'] = $email_error;
    }
    if (!empty($password_error)) {
        $errors['password'] = $password_error;
    }

    if (empty($errors)) {
        $sql = "SELECT id, username, email, usertype, password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // if (password_verify($hashed_password, $row['password'])) {
               if($hashed_password === $row["password"]){
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['usertype'] = $row['usertype'];

                
                header('location: http://localhost/siddhesh/php2/home.php?user_id=' . $row['id']);
                exit();
            } else {
                $errors['password'] = "Invalid password.";
            }
        } else {
            $errors['email'] = "Email not found.";
        }
      }

    // Display errors to the user
      $_SESSION['errors'] = $errors;
      header('location: http://localhost/siddhesh/php2/login.php');
      exit();
   }

   function test_input($data)
   {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }

   function validate_email($email)
   {
      if (empty($email)) {
         return "Email is required.";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         return "Invalid email format.";
      }

      return "";
   }

   function validate_password($password)
   {
      if (empty($password)) {
         return "Password is required.";
      } elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
         return "Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long.";
      }
      return "";
   }

   ?>
   <div class="container ">
         <div class="row justify-content-center">
            <div class="col-md-5 p-5 mr-2">
               <div class="card h-56 card-shadow" style="width:25rem;">
                  <div class="card-body">
                     <h3 class="text-center mb-4">Login</h3>
                     <form action="login.php" method="post">
                        <div class="form-floating mb-3">
                           <input type="email" class="form-control form-control-sm" name="email" id="email" required placeholder="Email">
                           <label for="email"><h6>User Name</h6></label>
                           <span class="error">
                           <?php
                           if (isset($_SESSION['errors']['email'])) {
                              echo $_SESSION['errors']['email'];
                           }
                           ?>
                           </span>
                        </div>
                        <div class="form-floating mb-3">
                           <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                           <label for="password"><h6>Password</h6></label>
                           <span class="error">
                           <?php
                           if (isset($_SESSION['errors']['password'])) {
                              echo $_SESSION['errors']['password'];
                           }
                           ?>
                           </span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <p>Do not have any account? <a href="http://localhost/siddhesh/php2/index.php">Register</a></p>
                        </div>
                     </form>
                  </div>
               </div>
               
            </div>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
      crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>