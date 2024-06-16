<?php
session_start();

@include '../config.php';
@include '../fconfig.php';

if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)) {
    header("Location: ../");
    exit();
}

function createNewUser($email, $password, $additionalData)
{
    global $auth, $database;

    try {
     
        $userProperties = [
            'email' => $email,
            'password' => $password,
        ];

        $createdUser = $auth->createUser($userProperties);

        $uid = $createdUser->uid;

        $userData = [
            'email' => $additionalData['demail'],
            'root' => $additionalData['rnumber'],
            'dest' => $additionalData['dest'],
            'ocontact' => $additionalData['ocontact'],
            'dcontact' => $additionalData['dcontact'],
            'blpnumber' => $additionalData['blpnumber'],
            'status' => 0, 
            'message' => 'test', 
            'location' => [
                'latitude' => 55.7558, 
                'longitude' => 37.6176, 
            ],
            'sub' => 0,
        ];

        $database->getReference("users/{$uid}")->set($userData);

        return $uid;
    } catch (\Kreait\Firebase\Exception\Auth\EmailExists $e) {
        return null;
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return null;
    }
}

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sql1 = "SELECT * FROM `shuttle` WHERE id = $id";

    $query1 = mysqli_query($conn, $sql1);

    $row = mysqli_fetch_assoc($query1);

    if ($row) {
        $email = $row['demail'];
        $password = $row['dpass'];
        $root = $row['rnumber'];
        $dest = $row['dest'];
        $ocontact = $row['ocontact'];
        $dcontact = $row['dcontact'];
        $blpnumber = $row['blpnumber'];

        $additionalData = [
            'demail' => $email,
            'rnumber' => $root,
            'dest' => $dest,
            'ocontact' => $ocontact,
            'dcontact' => $dcontact,
            'blpnumber' => $blpnumber,
        ];

        $uid = createNewUser($email, $password, $additionalData);

        if ($uid) {
            echo 'User creation successful. UID: ' . $uid;

            $updateSql = "UPDATE `shuttle` SET access = 1, uid = '$uid' WHERE id = $id";
            $updateQuery = mysqli_query($conn, $updateSql);

            if ($updateQuery) {
                echo 'Access updated successfully.';

                
            } else {
                echo 'Failed to update access.';
            }
        } else {
            echo 'User creation failed.';
        }
    } else {
        echo 'No data found for the specified ID.';
    }
}
?>