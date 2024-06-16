<?php
session_start();

@include '../config.php';
@include '../fconfig.php';

//checking user sign in or out
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)) {
    header("Location: ../");
    exit();
}

//deleting firebaseuser
function deleteFirebaseUser($uid)
{
    global $auth, $database;

    try {
        $auth->deleteUser($uid);
        $database->getReference("users/{$uid}")->remove();

        return true;
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}


if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];

    $sql1 = "SELECT * FROM `shuttle` WHERE id = $id";
    $query1 = mysqli_query($conn, $sql1);
    $shuttleData = mysqli_fetch_assoc($query1);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['driverEmail']) && !empty($_POST['driverEmail'])) {
            $driverEmail = mysqli_real_escape_string($conn, $_POST['driverEmail']);
            $updatedriverEmail = "UPDATE `shuttle` SET demail = '$driverEmail' WHERE id = $id";
            mysqli_query($conn, $updatedriverEmail);
           
        }
        if (isset($_POST['driverPassword']) && !empty($_POST['driverPassword'])) {
            $driverPassword = mysqli_real_escape_string($conn, $_POST['driverPassword']);
            $updatedriverPassword = "UPDATE `shuttle` SET dpass = '$driverPassword' WHERE id = $id";
            mysqli_query($conn, $updatedriverPassword);
          
        }
        $uid = $shuttleData['uid'];

        if ($uid) {
            $deleted = deleteFirebaseUser($uid);

            if ($deleted) {
                echo 'User deleted from Firebase successfully.';
                header("Location: access.php?id={$shuttleData['id']}");

            } else {
                echo 'Failed to update user details from Firebase.';
            }
        }
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
   <style>        .fixed-bottom {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #000; /* Adjust as needed */
    color: #fff; /* Adjust as needed */
    padding: 20px; /* Adjust as needed */
    text-align: center;</style>
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
                        <li class="nav-item"><a class="nav-link me-lg-3" href="./">Dashboard</a></li>
                    </ul>
                </div>
            </div>
        </nav>
  <br><br><br>
<div class="container-fluid">
    <div class="container">
        <br>
        <h3>Shuttle Registration</h3><hr>
        <br><br><br>

        <form action="dedit.php?id=<?php echo $id; ?>" method="post" name="uev" style="max-width: 400px; margin: 0 auto;border: 1px solid black; padding: 20px;" onsubmit="return validateShuttles()"  enctype="multipart/form-data">
        <div class="mb-3">
                <label for="driverEmail" class="form-label">Driver's Email</label>
                <input type="email" class="form-control" id="driverEmail" name="driverEmail" value="<?php echo $shuttleData['demail']; ?>">
            </div>

            <div class="mb-3">
                <label for="driverPassword" class="form-label">Driver's Passwords</label>
                <input type="password" class="form-control" id="driverPassword" name="driverPassword" value="<?php echo $shuttleData['dpass']; ?>">
            </div>
            <button type="submit" class="btn btn-dark" style="font-size: 14px;" aria-describedby="accountHelp" name="submit">update</button>
        </form>
        <br><br>
    </div>

<!--Bootstrap 5-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!--add main.js-->
<script type="text/javascript" src="../main.js"></script>
<br>
    </div>
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
</body>
</html>

