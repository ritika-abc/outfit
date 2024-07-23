 <?php

    // 
    session_start();

    include "config.php";

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $password = md5($_POST['password']);


        $result = mysqli_query($con, "select * 
     from admin WHERE name='$name' and password='$password'");
        $user_matched = mysqli_num_rows($result);
        if ($user_matched > 0) {
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;

            echo "<script>alert('Welcome')</script>";

            header("location:index.php");
        } else {
            echo "<script>alert('not matched !!!!')</script>";
        }
    }
    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login Page </title>
     <!-- Bootstrap CSS -->

     <link href="./gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

     <link href="./gentelella-master/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

     <link href="./gentelella-master/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

     <link href="./gentelella-master/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />

     <link href="./gentelella-master/build/css/custom.min.css" rel="stylesheet">

     <!-- Custom CSS -->
     <style>
         .login-container {
             max-width: 400px;
             margin: 100px auto;
             padding: 20px;
             background-color: #fff;
             border-radius: 5px;
             box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
             animation: slideUp 0.5s ease;
         }

         @keyframes slideUp {
             from {
                 transform: translateY(20px);
                 opacity: 0;
             }

             to {
                 transform: translateY(0);
                 opacity: 1;
             }
         }
     </style>
 </head>

 <body>
     <div class="container">
         <div class="login-container">
             <h2 class="text-center">Login </h2>
             <!-- <p class="mt-3 text-success fw-bold ">?php echo ($_SESSION["otp"] == "") ? 'verification First': " OTP verification successful. You can now proceed with Login."; ?></p> -->
             <p class="mt-3 text-success fw-bold ">Welcome Admin</p>
             <form method="post">
                 <!-- <p >OTP verification successful. You can now proceed with Login.</p> -->
                 <div class="form-group mt-3">
                     <label >Username </label>
                     <input type="text" name="name" class="form-control mt-2" placeholder="Enter username ">
                 </div>
                 <div class="form-group mt-3">
                     <label for="email">Enter Your Password</label>
                     <input type="password" name="password" class="form-control mt-2" placeholder="Enter Your Password">
                 </div>
                 <button type="submit" name="submit" class="btn btn-primary btn-block mt-3 w-100">Login</button>
                 <a href="logout.php" class="btn btn-danger fw-bold w-100 py-2 mt-3">logout</a>
             </form>
         </div>
     </div>

     <script src="bootstrap/js/bootstrap.min.js"></script>

 </body>

 </html>