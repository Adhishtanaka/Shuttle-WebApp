<?php

session_start(); 

//connect database with config.php
@include '../config.php';

if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true) {
    header("Location: ../dashboard");
    exit();
}

//check for submit 
if(isset($_POST["submit"])){

    //add data from form into variables
    $email = $_POST["email"];
    $password = $_POST["password"];
    

    //check for any records for matching username & password
    $sql = "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'";

    //execute that SQL query
    $result = mysqli_query($conn, $sql);

    //check that query returns anything
   if(mysqli_num_rows($result) > 0){

    // Set session variables
    $_SESSION['user_logged_in'] = true;
    $_SESSION['email'] = $email;

    // Redirect to the dashboard
    header("Location: ../dashboard");
    exit();
} else {
    // If the query returns nothing, show an alert box to check Email & password
    echo "<script>
            alert('Check Email & password Again');
            window.location.href = './';
        </script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>NSBM-Tracking Services</title>
        <link rel="icon" type="image/x-icon" href="assets/tracking.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../css/styles.css" rel="stylesheet" />
        <style>
            .fixed-bottom {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #000; /* Adjust as needed */
    color: #fff; /* Adjust as needed */
    padding: 20px; /* Adjust as needed */
    text-align: center;
}

        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="../../">NSBM</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <li class="nav-item"><a class="nav-link me-lg-3" href="../../">Home</a></li>
                    </ul>
                </div>
            </div>
        </nav>
  <br><br><br>
    <div class="container-fluid">
        <div class="container">

            <br><br><br>
            <!--sign in form  -->
            <form action="index.php" method="post" name="sin" style="max-width: 300px; margin: 0 auto; border: 1px solid black; padding: 20px;" onsubmit="return validatesin()">
                <div class="mb-3">
                    <label for="exampleInputEmail2" class="form-label" style="font-size: 14px;">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail2" name="email">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword2" class="form-label" style="font-size: 14px;">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword3" name="password">
                </div>
                <button type="submit" class="btn btn-dark" style="font-size: 14px;" aria-describedby="accountHelp" name="submit">Sign In</button>
                <br><br>
            </form>
        </div>
    </div>
     <!-- Footer-->
     <footer class="bg-black text-center py-5 fixed-bottom">
            <div class="container px-5">
                <div class="text-white-50 small">
                    <div class="mb-2">&copy; BusLocatingApp 2023. All Rights Reserved.</div>
                    <a href="#!">Privacy</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">Terms</a>
                    <span class="mx-1">&middot;</span>
                    <a href="#!">FAQ</a>
                </div>
            </div>
        </footer>
</body>
</html>


