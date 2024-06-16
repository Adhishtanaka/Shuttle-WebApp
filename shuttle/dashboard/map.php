<?php
session_start();

// Include necessary files
include '../config.php';
include '../fconfig.php';

// Redirect if user is not logged in
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)) {
    header("Location: ../");
    exit();
}

// Function to get user details from Firebase
function getUserDetails($uid)
{
    global $database;

    return $database->getReference("users/{$uid}")->getValue();
}

// Function to get bus details from MySQL
function getBusDetails($id)
{
    global $conn;

    $sql = "SELECT * FROM `shuttle` WHERE id = $id";
    $query = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($query);
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
    <div class="container">
    <br>
        <h3>Shuttles Map</h3>
        <hr>
        <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $busDetails = getBusDetails($id);

            if ($busDetails) {
                $uid = $busDetails['uid'];
                $userDetails = getUserDetails($uid);
                echo "<p>License Plate Number: " . $userDetails['blpnumber'] . "</p>";
                if($userDetails['status'] == 0){
                    echo "<p>Shuttle Status: Offline</p>";  
                }else{
                    echo "<p>Shuttle Status: " . $userDetails['message'] . "</p>";
                }             
                echo "<p>Bus Subscribers: " . $userDetails['sub'] . "</p>";

                $latitude = $userDetails['location']['latitude'];
                $longitude = $userDetails['location']['longitude'];
            } else {
                echo '<p class="text-danger">No data found for the specified ID.</p>';
            }
        } else {
            echo '<p class="text-danger">ID parameter is missing.</p>';
        }
        ?>

        <div id="map">
            <iframe width="100%" height="400" frameborder="0" style="border:0"
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB3UwrK5AdZquAC-TgxA-zz9cjZ-BpJG5k&q=<?php echo $latitude . ',' . $longitude; ?>"
                allowfullscreen=true f>
            </iframe>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<br><br><br>
<!-- Footer-->
<footer class="bg-black text-center py-5 ">
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
