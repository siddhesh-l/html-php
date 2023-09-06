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
   <div class="container ">
         <div class="row justify-content-center">
            <div class="col-md-4 p-4 mr-6">
               <div class="card h-56 card-shadow" style="width:25rem;">
                  <div class="card-body">
                     <h3 class="text-center mb-4">Registration Form</h3>
                     <form action="registration.php" method="post">
                        <div class="form-floating mb-3">
                           <input type="text" class="form-control" id="flotingName" required placeholder="Name">
                           <label for="flotingName"><h6>Name</h6></label>
                        </div>
                        <div class="form-floating mb-3">
                           <input type="email" class="form-control form-control-sm" name="floatingEmail" id="email" required placeholder="Email">
                              <label for="floatingEmail"><h6>Email address</h6></label>
                        </div>
                        <div class="form-floating mb-3">
                           <input type="password" class="form-control" name="flotingPassword" id="password" placeholder="Password" required>
                           <label for="flotingPassword"><h6>Password</h6></label>
                        </div>
                        <div class="form-floating mb-3">
                           <input type="number" class="form-control" id="" name="floatingPhone" required
                              placeholder="Phone Number">
                              <label for="floatingPhone"><h6>Phone Number</h6></label>
                        </div>
                        <div class="mb-3">
                           <label for="gender" class="mb-2"><h6>Gender</h6></label><br>
                           <input type="radio" name="gender" id="male" value="male"><label for="male">Male</label>
      
                           <input type="radio" name="gender" id="female" value="female">
                           <label for="female">Female</label>
                        </div>
      
                        <div class="mb-3">
                           <label for="gender" class="mb-2"><h6>User Type</h6></label><br>
                           <input type="radio" name="type" id="user" value="user">
                           <label for="male">User</label>
      
                           <input type="radio" name="type" id="admin" value="admin">
                           <label for="female">Admin</label>
                        </div>
      
                        <button type="submit" class="btn btn-primary w-100">Register</button><br>
                        <p>Do not have any account? <a href="http://localhost/siddhesh/Forms/backend/login.php">Login</a></p>
      
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