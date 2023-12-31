<?php
// error_reporting(0);
//Call the Database File
session_start();
require_once 'db_helper.php';

$user_data = array(
   'id' => '',
   'username' => '',
   'phone' => '',
   'gender' => ''
);

//Check the user is logged in, if not, redirect the log in page

if (!isset($_SESSION['id'])) {
   header("location:http://localhost/siddhesh/php2/login.php");
   exit;
}

if (isset($_GET['id'])) {
   $user_id = $_GET['id'];
   // echo $user_id;
   //Query to fetch user data by id

   $sql = "SELECT * FROM users WHERE id='$user_id'";
   $result = mysqli_query($conn, $sql);
   // print_r($result);
   if ($result) {
      $user_row = mysqli_fetch_assoc($result);

      $user_data = array(
         'id' => $user_row['id'],
         'username' => $user_row['username'],
         'phone' => $user_row['phone'],
         'gender' => $user_row['gender']
     );
   //   print_r($user_data);die;
      //Handle form submission  
   }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   $new_id = mysqli_real_escape_string($conn, $_POST['new_id']);
   $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);
   $new_phone = mysqli_real_escape_string($conn, $_POST['new_phone']);
   $new_gender = mysqli_real_escape_string($conn, $_POST['new_gender']);

   $update_sql = "UPDATE users SET username = '$new_username', phone = '$new_phone', gender = '$new_gender' WHERE id = $new_id";


   if (mysqli_query($conn, $update_sql)) {
      //Update session data with new information
     

      echo "Update data sussessfully";

      header("location:http://localhost/siddhesh/php2/home.php");
   } else {
      echo "error" . mysqli_error($conn);
   }
}
mysqli_close($conn);

session_write_close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

   <title>Home Page</title>

   <style>
      .gradient-background {

         height: 723px;
      }

      body {
         align-items: center;
         margin: 0;
         padding-top: 90px;
         height: 100vh;

         background: linear-gradient(135deg, #d9ffbd, #9effdf, #fdbdff, #cfc2ff);
      }
   </style>


</head>

<body>
   <div class="container">
      <div class="row justify-content-center align-item center">
         <div class="col-md-5">
            <div class="card p-4">
               <div class="card-body">
                  <h3 class="card-title text-center">Update Personal Information</h3><br>
                  <form method="post" action="update.php">
                     <div class="input-group">
                        <div class="input-group-prepend">

                        </div>
                     </div>
                     <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="basic-addon1">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                           </svg>
                        </span>
                        <input type="hidden" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="new_id" value="<?php echo $user_data['id']; ?>">
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="new_username" value="<?php echo $user_data['username']; ?>">
                     </div><br>
                     <div class="input-group input-group-lg mb-3">
                        <span class="input-group-text" id="basic-addon1">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                              <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                           </svg>
                        </span>
                        <input type="number" class="form-control" placeholder="Mobile" aria-label="Mobile" name="new_phone" aria-describedby="basic-addon1" value="<?php echo $user_data['phone']; ?>">
                     </div><br>
                     <div class="mb-3">
                        <label for="new_gender" class="mb-2">
                           <h6>Gender</h6>   
                        </label><br>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="new_gender" id="male" value="male" <?php echo ($user_data['gender'] === 'male') ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check">
                           <input class="form-check-input" type="radio" name="new_gender" id="female" value="female" <?php echo ($user_data['gender'] === 'female') ? 'checked' : ''; ?>>
                           <label class="form-check-label" for="female">Female</label>
                        </div>
                     </div><br>
                     <div class="row">
                        <div class="col-md-6">
                           <button type="Update" class="btn btn-outline-primary w-100" value="submit">Update</button>
                        </div>
                        <div class="col-md-6">
                           <a href="update.php"><button type="Update" class="btn btn-outline-danger w-100">Cancle</button></a>
                        </div>

                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Personal Information Card -->

   </div>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>