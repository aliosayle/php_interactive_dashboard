<?php
// Enable error reporting for development
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php'; // Ensure $link is defined here

// Check if the user has permission to delete
$user_id = $_SESSION['id'];
echo "User ID: $user_id<br>"; // Debugging line

$permission_query = "SELECT candelete FROM users WHERE id = '$user_id'";
echo "Permission Query: $permission_query<br>"; // Debugging line
$result = mysqli_query($link, $permission_query);

if (!$result) {
    echo "Error in querying user permissions: " . mysqli_error($link) . "<br>";
    exit();
}

$permission = mysqli_fetch_assoc($result)['candelete'];
echo "Permission: $permission<br>"; // Debugging line

if ($permission != 1) {
    echo "User does not have permission to delete.<br>";
    exit();
}

// Debugging the GET parameters
echo "GET Parameters: ";
print_r($_GET); // Debugging line

// Check if 'bon_id' parameter is provided in the URL
if (isset($_GET['bon_id'])) {
    $bon_id = $_GET['bon_id'];
    echo "Bon ID to delete: $bon_id<br>"; // Debugging line

    // Prepare and execute delete query
    $delete_query = "DELETE FROM bon WHERE id = '$bon_id'";
    echo "Delete Query: $delete_query<br>"; // Debugging line

    if (mysqli_query($link, $delete_query)) {
        echo "Bon deleted successfully.<br>";
        // Redirect to another page after successful deletion (optional)
        header("Location: bons.php");
        exit();
    } else {
        echo "Error deleting bon: " . mysqli_error($link) . "<br>";
    }
} else {
    echo "No 'bon_id' parameter provided.<br>";
}

// Close the linkection
header("Location: bons.php")
?>
