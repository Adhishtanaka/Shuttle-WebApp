<?php

session_start();
@include '../config.php';
@include '../fconfig.php';

//check signinsign up
if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)) {
    header("Location: ../");
    exit();
}

if (!isset($_GET['id'])) {
    echo 'Error: Shuttle ID not provided.';
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM `shuttle` WHERE id = $id";
$query = mysqli_query($conn, $sql);
$shuttleData = mysqli_fetch_assoc($query);

if (!$shuttleData) {
    echo 'Error: No data found for the specified ID.';
    exit();
}

//update shuttle data
function updateShuttleData($id, $blpnum, $ownerContact, $driverContact, $routeNumbers, $destination)
{
    global $conn, $auth, $database;

    $sql = "SELECT * FROM `shuttle` WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    $shuttleData = mysqli_fetch_assoc($query);

    if (!$shuttleData) {
        return false;
    }

    if (!empty($_FILES['vehicleImage']['name']) && $_FILES['vehicleImage']['size'] > 0) {
        $oldVehicleImagePath = '../upload/' . basename($shuttleData['bimage']);
        unlink($oldVehicleImagePath);
        $newVehicleImage = uploadFile('vehicleImage');
        $updateVehicleImageSql = "UPDATE `shuttle` SET bimage = '$newVehicleImage' WHERE id = $id";
        $updateVehicleImageQuery = mysqli_query($conn, $updateVehicleImageSql);

        if (!$updateVehicleImageQuery) {
            return false;
        }
    }

    if (!empty($_FILES['driverNICImage']['name']) && $_FILES['driverNICImage']['size'] > 0) {
        $oldDriverNICImagePath = '../upload/' . basename($shuttleData['dnicimage']);
        unlink($oldDriverNICImagePath);
        $newDriverNICImage = uploadFile('driverNICImage');
        $updateDriverNICImageSql = "UPDATE `shuttle` SET dnicimage = '$newDriverNICImage' WHERE id = $id";
        $updateDriverNICImageQuery = mysqli_query($conn, $updateDriverNICImageSql);

        if (!$updateDriverNICImageQuery) {
            return false;
        }
    }

    $updateSql = "UPDATE `shuttle` SET 
        blpnumber = '$blpnum',
        ocontact = '$ownerContact',
        dcontact = '$driverContact',
        rnumber = '$routeNumbers',
        dest = '$destination'
        WHERE id = $id";

    $updateQuery = mysqli_query($conn, $updateSql);

    if (!$updateQuery) {
        return false;
    }

    try {
        $uid = $shuttleData['uid'];

        $userData = [
            'ocontact' => $ownerContact,
            'dcontact' => $driverContact,
            'blpnumber' => $blpnum,
            'dest' => $destination,
            'root' => $routeNumbers

        ];

        $database->getReference("users/{$uid}")->update($userData);

        return true;
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}

if (isset($_POST['submit'])) {
    $blpnum = $_POST['blpnum'];
    $ownerContact = $_POST['ownerContact'];
    $driverContact = $_POST['driverContact'];
    $routeNumbers = $_POST['routeNumbers'];
    $destination = $_POST['destination'];

    $updateResult = updateShuttleData($id, $blpnum, $ownerContact, $driverContact, $routeNumbers, $destination);

    if ($updateResult) {
        header("Location: details.php?id={$shuttleData['id']}");
    } else {
        echo 'Failed to update data.';
    }
}

//uploading file function
function uploadFile($inputName)
{
    $uploadDirectory = '../upload/';
    if ($_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
        echo "File upload failed with error code " . $_FILES[$inputName]['error'];
        return false;
    }
    $filename = uniqid() . '_' . basename($_FILES[$inputName]['name']);
    $targetPath = $uploadDirectory . $filename;
    if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetPath)) {
        return $targetPath;
    } else {
        echo "File move failed";
        return false;
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
        <h3>Edit Shuttle Details</h3>
        <hr>
        <br>

        <form style="max-width: 400px; margin: 0 auto;border: 1px solid black; padding: 20px;" action="oedit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
         <div class="mb-3">
                <label for="blpnum" class="form-label">Vehicle License Plate Number </label>
                <input type="text" class="form-control" id="blpnum" name="blpnum" value="<?php echo $shuttleData['blpnumber']; ?>">
            </div>

            <div class="mb-3">
                <label for="vehicleImage" class="form-label">Vehicle Image</label>
                <input class="form-control" type="file" id="vehicleImage" accept=".jpg, .jpeg, .png, .svg, .gif, .webp" name="vehicleImage">
            </div>

            <div class="mb-3">
                <label for="ownerContact" class="form-label">Owner's Contact Number</label>
                <input type="text" class="form-control" id="ownerContact" name="ownerContact" value="<?php echo $shuttleData['ocontact']; ?>">
            </div>
      

            <div class="mb-3">
                <label for="driverContact" class="form-label">Driver's Contact Number</label>
                <input type="text" class="form-control" id="driverContact" name="driverContact" value="<?php echo $shuttleData['dcontact']; ?>">
            </div>

            <div class="mb-3">
                <label for="driverNICImage" class="form-label">Driver's License Image</label>
                <input class="form-control" type="file" id="driverNICImage" accept=".jpg, .jpeg, .png, .svg, .gif, .webp" name="driverNICImage">
            </div>

            <div class="mb-3">
                <label for="routeNumbers" class="form-label">Route Numbers</label>
                <input type="text" class="form-control" id="routeNumbers" name="routeNumbers" value="<?php echo $shuttleData['rnumber']; ?>">
            </div>

            <div class="mb-3">
                <label for="destination" class="form-label">Destination</label>
                <input type="text" class="form-control" id="destination" name="destination" value="<?php echo $shuttleData['dest']; ?>">
            </div>

            <button type="submit" class="btn btn-dark" style="font-size: 14px;" aria-describedby="accountHelp" name="submit">Update</button>
            <a href="dedit.php?id=<?php echo $shuttleData['id']?>" class="btn btn-primary">change Driver Email & password</a>
            <br>
        </form>
        <br>
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
