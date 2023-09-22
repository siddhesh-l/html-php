<?php
session_start();
// var_dump($_SESSION);
error_reporting(0);



if (!isset($_SESSION['id'])) {
   header('location:http://localhost/siddhesh/php2/login.php');
   exit();
}

$is_admin = ($_SESSION['usertype'] === 'admin');


// echo $_SESSION['id'];
// echo $_SESSION['name'];
// echo $_SESSION['email'];

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
         margin: 0;
         padding: 0;
         height: 100vh;
         background: linear-gradient(135deg, #d9ffbd, #9effdf, #fdbdff, #cfc2ff);
      }

      .navbar-graient-background {
         background: linear-gradient(45deg, #d9ffbd, #9effdf, #fdbdff, #cfc2ff);
      }

      .heading {
         color: skyblue;
      }

      .tb,
      .thd {
         padding: none;
         margin: none;
         text-align: center;
      }

      .bttn {
         padding: 0%;
         margin: 0%;
         height: 35px;
         width: 35px;
         border: none;
         outline: none;
         background: none;

      }

      .table-no-padding td,
      .table-no-padding th {
         padding: 4.5px;
      }

      .table-centerd-text td,
      .table-centerd-text th {
         vertical-align: middle;
         text-align: center;
      }

      .custom-edit-icon-color {
         color: #1E8BD3;
      }

      .custom-delete-icon-color {
         color: #FF0000;
      }

      .custome-search-btn {
         outline: none;
         background: none;
         border: none;
      }

      .input-group-text {
         padding: none;
      }
   </style>


</head>

<body>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="profilepage.php">
               <?php
               if (isset($_SESSION['name'])) {
                  echo "Welcome  " . $_SESSION['name'];
               } ?>
            </a>
            form
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            </ul>
            <form class="d-flex" role="search">


               <a href="logout.php"><button class="btn btn-outline-danger me-2" type="button">Logout</button></a>
            </form>
         </div>
      </div>
   </nav>

   <div class="container mt-3">
      <nav class="navbar navbar-expand-lg">
         <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle bg-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown Button
                     </a>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                           <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                     </ul>
                  </li>
               </ul>
               <form class="d-flex" role="search">
                  <div class="input-group">

                     <span class="input-group-text" id="basic-addon1">
                        <button class="btn" type="submit" style="width: 20px; padding: 0%; margin:0%; height: 30px;">
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search custome-search-btn" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                           </svg>
                        </button>
                     </span>

                     <input type="text" class="form-control me-2" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                  </div>
               </form>
            </div>
         </div>
      </nav>

      <br>
      <div class="table-responsive">
         <table class="table table-striped table-no-padding table-centerd-text table-bordered border-dark table-hover">
            <thead class="thd">
               <tr>
                  <th>ID</th>
                  <th>Profile image</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Gender</th>
                  <th>User Type</th>
                  <?php if($is_admin){
                     ?>
                     <th colspan='2'>Opration</th>
                     <?php
                     }?>
                  
                  
               </tr>
            </thead>
            <tbody class="tb">
               <!-- Rows of user data will be added here -->
               <!-- Example row -->
               <?php
               include 'db_helper.php';

               // Define the number of records per page
               $recordsPerPage = 10;

               // Get the current page number from the URL, default to page 1
               $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;

               // Calculate the offset
               $offset = ($current_page - 1) * $recordsPerPage;

               $user_id = $_SESSION['id'];

               // Query to fetch data for the current page
               $sql = "SELECT * FROM users WHERE id != $user_id LIMIT $offset, $recordsPerPage";
               $result = mysqli_query($conn, $sql);

               // $user_role = $_SESSION['usertype'];
               // $is_admin = ($user_role == 'admin');
               // Check if there are records to display
               if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                     echo "<tr>";
                     echo "<td>" . $row["id"] . "</td>";
                     $image_path = $row['user_image'];
                     echo "$image_path";
                     echo "<td><img src='$row[user_image]' alt='User Image' width='30' height='30'></td>"; // Add this line
                     echo "<td>" . $row["username"] . "</td>";
                     echo "<td>" . $row["email"] . "</td>";
                     echo "<td>" . $row["phone"] . "</td>";
                     echo "<td>" . $row["gender"] . "</td>";
                     echo "<td>" . $row["usertype"] . "</td>";
                    
                     if($is_admin){
                        echo "<td><a href='update.php?id=" . $row["id"] . "'><i class='bi bi-pencil-square' style='color:blue'></i></a></td>";
                        echo "<td><a href='delete.php?id=" . $row["id"] . "' onclick='return checkedelete()'><i class='bi bi-trash' style='color:red'></i></a></td>";
                     }

                    
                     
                     
                     echo "</tr>";
                  }
               } else {
                  echo "<tr><td colspan='8'>No Data Found</td></tr>";
               }

               // Calculate the total number of pages
               $sql = "SELECT COUNT(*) AS total FROM users WHERE id != $user_id";
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
               $total_records = $row["total"];
               $total_pages = ceil($total_records / $recordsPerPage);

               echo "</tbody></table>";

               // Pagination links
               echo '<nav aria-label="Page navigation">';
               echo '<ul class="pagination justify-content-center">';

               if ($current_page > 1) {
                  echo '<li class="page-item"><a class="page-link" href="home.php?page=' . ($current_page - 1) . '">Previous</a></li>';
               } else {
                  echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a></li>';
               }

               for ($i = 1; $i <= $total_pages; $i++) {
                  if ($i == $current_page) {
                     echo '<li class="page-item active" aria-current="page"><a class="page-link" href="#">' . $i . '<span class="visually-hidden">(current)</span></a></li>';
                  } else {
                     echo '<li class="page-item"><a class="page-link" href="home.php?page=' . $i . '">' . $i . '</a></li>';
                  }
               }

               if ($current_page < $total_pages) {
                  echo '<li class="page-item"><a class="page-link" href="home.php?page=' . ($current_page + 1) . '">Next</a></li>';
               } else {
                  echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a></li>';
               }

               echo '</ul></nav>';
               ?>


               <!-- Add more rows as needed -->
            </tbody>
         </table>
      </div>


      <!-- Pagination -->

   </div>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <script>
      function checkedelete(){
         return confirm('Conform');
      }
   </script>
</body>

</html>