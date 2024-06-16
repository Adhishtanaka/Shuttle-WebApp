<?php
session_start();
@include '../config.php';
@include '../fconfig.php';

if (!(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true)) {
    header("Location: ../");
    exit();
}

//deleting firebase user
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

//deleting images and entry from mysql
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    $sql_select = "SELECT onicimage, dnicimage, bimage, uid FROM shuttle WHERE id = $id";
    $result_select = mysqli_query($conn, $sql_select);

    if ($result_select) {
        $row = mysqli_fetch_assoc($result_select);
        $uid = $row['uid'];

        if ($uid) {
            $deleted = deleteFirebaseUser($uid);

            if ($deleted) {
                echo 'User deleted from Firebase successfully.';
            } else {
                echo 'Failed to delete user from Firebase.';
            }
        }

        $imagePaths = [$row['onicimage'], $row['dnicimage'], $row['bimage']];
        foreach ($imagePaths as $imagePath) {
            if (!empty($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        
        $sql_delete = "DELETE FROM `shuttle` WHERE id = $id";
        $query_delete = mysqli_query($conn, $sql_delete);

        header('Location: index.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
