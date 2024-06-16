<?php
session_start();

@include '../config.php';

//check user login
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)) {
    header("Location: ../");
    exit();
}
//select bus details and check it.
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];

    $sql1 = "SELECT * FROM `shuttle` WHERE id = $id";
    $query1 = mysqli_query($conn, $sql1);
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
    <div class="container-fluid">
        <div class="container">
    <div class="container">
        <br>
        <h3>Shuttle Details</h3>
        <hr>
        <br>
        <?php foreach ($query1 as $q) { ?>
            <!--bootstrap5 card-->
            <center>
                <div style="max-width: 500px;" class="card md-6">
                    <div class="card-body">
                        <?php $imageSource = $q['bimage']; ?>
                        <img style="max-width: 100%; height: auto;" src="<?php echo $imageSource; ?>" class="card-img-top border border-dark img-fluid" alt="...">
                        <br><br>
                        <u>
                            <h6><?php echo $q['blpnumber']; ?></h6>
                        </u><br>
                        <p><strong>Owner's Name:</strong> <?php echo $q['onic']; ?></p>
                        <p><strong>Owner's Contact Number:</strong> <?php echo $q['ocontact']; ?></p>
                        <p><strong>Driver's Contact Number:</strong> <?php echo $q['dcontact']; ?></p>
                        <p><strong>Driver's Email:</strong> <?php echo $q['demail']; ?></p>
                        <p><strong>Owner's NIC Image:</strong> <a href="<?php echo $q['onicimage']; ?>" target="_blank">View Image</a></p>
                        <p><strong>Driver's License Image:</strong> <a href="<?php echo $q['dnicimage']; ?>" target="_blank">View Image</a></p>
                        
    <br>
                        <p><strong>Route Numbers: <?php echo $q['rnumber']; ?></strong></p>
    <p><strong>Destination:<?php echo $q['dest']; ?></strong></p>
    <br>
    <?php

                        if ($q['access'] == 0) {
                            ?>
                            <form action="#" method="post" class="m-3" data-bs-toggle="modal" data-bs-target="#giveAccessModal-<?php echo $q['id'] ?>">
                                <button type="button" class="btn btn-success">Give Access</button>
                            </form>
                            <div class="modal fade" id="giveAccessModal-<?php echo $q['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Access</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to give access?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <a href="access.php?id=<?php echo $q['id'] ?>" class="btn btn-success">Give Access</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }else{ ?>
                            <a href="map.php?id=<?php echo $q['id'] ?>" class="btn btn-primary">Realtime Updates</a>
                            <a href="oedit.php?id=<?php echo $q['id'] ?>" class="btn btn-primary">Edit</a>
                        <?php
                        }
                        ?>

<form action="#" method="post" class="m-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                <button type="button" class="btn btn-dark">Remove</button>
</form> 
   

                    </div>
                </div>
                <br>
            </center>

            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this shuttle?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="delete.php?id=<?php echo $q['id']?>" class="btn btn-danger">Remove</a>
            </div>
        </div>
    </div>
</div>
        <?php } ?>
    </div>
    </div>
    </div>
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
