<?php
session_start();

@include '../config.php';

if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)) {
    header("Location: ../");
    exit();
}

//giving access to shuttle
$accessValue = isset($_GET['access']) && $_GET['access'] == 1 ? 1 : 0;

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM `shuttle` WHERE `blpnumber` LIKE '%$search%' AND `access` = '$accessValue'";
} else {
    $sql = "SELECT * FROM `shuttle` WHERE `access` = '$accessValue'";
}

$query = mysqli_query($conn, $sql);
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
        .switch-label {
            margin-left: 10px;
        }
        .fixed-bottom {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #000; /* Adjust as needed */
    color: #fff; /* Adjust as needed */
    padding: 20px; /* Adjust as needed */
    text-align: center;
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var switchElement = document.getElementById('accessSwitch');
            var switchLabel = document.getElementById('accessSwitchLabel');

            switchElement.addEventListener('change', function () {
                switchLabel.textContent = this.checked ? 'Shuttles' : 'Requests';
                this.closest('form').submit();
            });
        });
    </script>
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

            <br>
    <div class="container">
        <br>
        <div class="form-check form-switch">
            <form method="GET" action="">
                <input type="hidden" name="access" value="0">
                <input class="form-check-input" type="checkbox" id="accessSwitch" name="access" value="1" <?php echo $accessValue == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="accessSwitch" id="accessSwitchLabel">
                    <?php echo $accessValue == 1 ? 'Shuttles' : 'Requests'; ?>
                </label>
                <button type="submit" style="display: none;"></button> 
            </form>
        </div>
        <br>

        <div class="row">
            <div class="col-12 mb-3">
                <form method="GET" action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="License Plate" name="search">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <br>


        <div class="row">
            <?php
            $counter = 0;

            if (mysqli_num_rows($query) <= 0) {
                echo '<br><center><h5>Empty <h5></center><br>';
            }

            foreach ($query as $q) {
            ?>
                <!--bootstrap5 card-->
                <div class="col-12 col-lg-4 d-flex justify-content-center mb-3">
                    <br>
                    <div class="card" style="width: 18rem; border: 1px solid black;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $q['blpnumber']; ?></h5>
                            <p class="card-text">Destination: <b><?php echo $q['dest']; ?></b></p>
                            <p class="card-text">Root Number: <b><?php echo $q['rnumber']; ?></b></p>
                            <a href="details.php?id=<?php echo $q['id'] ?>" class="btn btn-dark">View</a>
                         </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
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
</html>
