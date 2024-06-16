<?php
include('./Shuttle/config.php');


if(isset($_POST['submit'])){

    $ownerNIC = $_POST['ownerNIC'];
    $ownerContact = $_POST['ownerContact'];
    $driverContact = $_POST['driverContact'];
    $driverEmail = $_POST['driverEmail'];
    $driverPassword = $_POST['driverPassword'];
    $routeNumbers = $_POST['routeNumbers'];
    $destination = $_POST['destination'];
    $blpnum = $_POST['blpnum'];

    //file uploading function
    function uploadFile($inputName) {
        $uploadDirectory = './Shuttle/upload/';
        $uploadDirectory1 = '../upload/';
        if ($_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
            echo "File upload failed with error code " . $_FILES[$inputName]['error'];
            return false;
        }
        $filename = uniqid() . '_' . basename($_FILES[$inputName]['name']);
        $targetPath = $uploadDirectory . $filename;
        $targetPath1 = $uploadDirectory1 . $filename;
        if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetPath)) {
            return $targetPath1;
        } else {
            echo "File move failed";
            return false;
        }
    }

    $ownerNICImage = uploadFile('ownerNICImage');
    $driverNICImage = uploadFile('driverNICImage');
    $vehicleImage = uploadFile('vehicleImage');


   //sql code
    $sql = "INSERT INTO shuttle (onic, ocontact, onicimage, dcontact, demail, dpass, dnicimage, rnumber, dest,access,blpnumber,bimage)
            VALUES ('$ownerNIC', '$ownerContact', '$ownerNICImage', '$driverContact', '$driverEmail', '$driverPassword', '$driverNICImage', '$routeNumbers', '$destination',0,'$blpnum','$vehicleImage')";

    //wxcution ofsql
    $result = mysqli_query($conn,$sql);
    if($result){
       echo '<script>alert("Details entered successfully.")</script>';
    } else {
        
        echo "Error: " . mysqli_error($conn);
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
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
            <div class="container px-5">
                <a class="navbar-brand fw-bold" href="#page-top">NSBM</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Home</a></li>
                        <li class="nav-item"><a class="nav-link me-lg-3" href="./shuttle/signin/index.php">Admin</a></li>
                    </ul>
                    <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                        <span class="d-flex align-items-center">
                            
                            <span class="small">Register As A Driver</span>
                        </span>
                    </button>
                </div>
            </div>
        </nav>
        <!-- Mashead header-->
        <header class="masthead">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <!-- Mashead text and app badges-->
                        <div class="mb-5 mb-lg-0 text-center text-lg-start">
                            <h1 class="display-1 lh-1 mb-3"><span style = "color:rgb(51, 204, 51);">NSBM</span> Transport Tracking App</h1>
                            <p class="lead fw-normal text-muted mb-5">NSBM University Transport Services Tracking App ensures seamless and efficient monitoring of transportation for a reliable and secure campus transport experience.</p>
                            <div class="d-flex flex-column flex-lg-row align-items-center">
                                <a class="me-lg-3 mb-4 mb-lg-0" href="#!"><img class="app-badge" src="assets/img/google-play-badge.svg" alt="..." /></a>
                                <a href="#!"><img class="app-badge" src="assets/img/app-store-badge.svg" alt="..." /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Masthead device mockup feature-->
                        <div class="masthead-device-mockup">
                            <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                        <stop class="gradient-start-color" offset="0%"></stop>
                                        <stop class="gradient-end-color" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <circle cx="50" cy="50" r="50"></circle></svg
                            ><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect></svg
                            ><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="50"></circle></svg>
                            <div class="device-wrapper">
                                <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                    <div class="screen bg-black">
                                        <!-- PUT CONTENTS HERE:-->
                                        <!-- * * This can be a video, image, or just about anything else.-->
                                        <!-- * * Set the max width of your media to 100% and the height to-->
                                        <!-- * * 100% like the demo example below.-->
                                        <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="assets/S.mp4" type="video/mp4" /></video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br><br><br><br><br><br>
        </header>
        
        
        <!-- App features section-->
        <section id="features">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                        <div class="container-fluid px-5">
                            <div class="row gx-5">
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-phone icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Real-Time Tracking</h3>
                                        <p class="text-muted mb-0">Keep tabs on the exact location of university transport vehicles in real time, allowing students and faculty to plan their journeys with precision.</p>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-5">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-camera icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Route Optimization</h3>
                                        <p class="text-muted mb-0">Optimize transportation routes to enhance efficiency, reduce travel time, and ensure a streamlined experience for users, minimizing delays and improving overall service.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-5 mb-md-0">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-gift icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Free to Use</h3>
                                        <p class="text-muted mb-0">Enjoy the benefits of the NSBM University Transport Services Tracking App, providing real-time tracking, route optimization, and push notifications—all at no cost.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Feature item-->
                                    <div class="text-center">
                                        <i class="bi-patch-check icon-feature text-gradient d-block mb-3"></i>
                                        <h3 class="font-alt">Push Notifications</h3>
                                        <p class="text-muted mb-0">Enable instant communication by sending push notifications, updating users on arrival times, delays, or any critical information, ensuring everyone stays informed and connected.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 order-lg-0">
                        <!-- Features section device mockup-->
                        <div class="features-device-mockup">
                            <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                                        <stop class="gradient-start-color" offset="0%"></stop>
                                        <stop class="gradient-end-color" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <circle cx="50" cy="50" r="50"></circle></svg
                            ><svg class="shape-1 d-none d-sm-block" viewBox="0 0 240.83 240.83" xmlns="http://www.w3.org/2000/svg">
                                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect></svg
                            ><svg class="shape-2 d-none d-sm-block" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="50"></circle></svg>
                            <div class="device-wrapper">
                                <div class="device" data-device="iPhoneX" data-orientation="portrait" data-color="black">
                                    <div class="screen bg-black">
                                        <!-- PUT CONTENTS HERE:-->
                                        <!-- * * This can be a video, image, or just about anything else.-->
                                        <!-- * * Set the max width of your media to 100% and the height to-->
                                        <!-- * * 100% like the demo example below.-->
                                        <video muted="muted" autoplay="" loop="" style="max-width: 100%; height: 100%"><source src="assets/D.mp4" type="video/mp4" /></video>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic features section-->
        <section class="bg-light">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                    <div class="col-12 col-lg-5">
                        <h2 class="display-4 lh-1 mb-4">About Us</h2>
                        <p class="lead fw-normal text-muted mb-5 mb-lg-0">We, a team of passionate undergraduates from NSBM Green University, are dedicated to developing a cutting-edge university transport tracking app as part of our group project. Committed to enhancing campus mobility, our project aims to provide an innovative and efficient solution for the entire university community.</p>
                    </div>
                    <div class="col-sm-8 col-md-6">
                        <div class="px-5 px-sm-0"><img class="img-fluid " src="assets/1.webp" alt="..." style="max-width: 100%; height: 100%"/></div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer-->
        <footer class="bg-black text-center py-5">
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
        <!-- Feedback Modal-->
        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-gradient-primary-to-secondary p-4">
                        <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Registration Form</h5>
                        <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body border-0 p-4">
                
                        <form action="index.php" method="post" name="uev" enctype="multipart/form-data" onsubmit="return validateShuttles()">
            
            <div class="mb-3">
                <label for="blpnum" class="form-label">Vehicle License Plate Number </label>
                <input required type="text" class="form-control" id="blpnum" name="blpnum">
            </div>

            <div class="mb-3">
                <label for="vehicleImage" class="form-label">Vehicle Image</label>
                <input required class="form-control" type="file" id="vehicleImage" accept=".jpg, .jpeg, .png, .svg, .gif, .webp" name="vehicleImage">
            </div>

            <div class="mb-3">
                <label for="ownerNIC" class="form-label">Owner's Name</label>
                <input required type="text" class="form-control" id="ownerNIC" name="ownerNIC">
            </div>

            <div class="mb-3">
                <label for="ownerContact" class="form-label">Owner's Contact Number</label>
                <input required type="text" class="form-control" id="ownerContact" name="ownerContact">
            </div>
      
            <div class="mb-3">
                <label for="ownerNICImage" class="form-label">Owner's NIC Image</label>
                <input required class="form-control" type="file" id="ownerNICImage" accept=".jpg, .jpeg, .png, .svg, .gif, .webp" name="ownerNICImage">
            </div>

            <div class="mb-3">
                <label for="driverContact" class="form-label">Driver's Contact Number</label>
                <input required type="text" class="form-control" id="driverContact" name="driverContact">
            </div>

            <div class="mb-3">
                <label for="driverEmail" class="form-label">Driver's Email</label>
                <input required type="email" class="form-control" id="driverEmail" name="driverEmail">
            </div>

            <div class="mb-3">
                <label for="driverPassword" class="form-label">Driver's Passwords</label>
                <input required type="password" class="form-control" id="driverPassword" name="driverPassword">
            </div>

            <div class="mb-3">
                <label for="driverNICImage" class="form-label">Driver's License Image</label>
                <input required class="form-control" type="file" id="driverNICImage" accept=".jpg, .jpeg, .png, .svg, .gif, .webp" name="driverNICImage">
            </div>

            <div class="mb-3">
                <label for="routeNumbers" class="form-label">Route Numbers</label>
                <input required type="text" class="form-control" id="routeNumbers" name="routeNumbers">
            </div>

            <div class="mb-3">
                <label for="destination" class="form-label">Destination</label>
                <input required type="text" class="form-control" id="destination" name="destination">
            </div>

            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary rounded-pill btn-lg " id="submitButton" type="submit" name="submit">Submit</button></div>
        </form>
        
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script type="text/javascript" src="./Shuttle/main.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
