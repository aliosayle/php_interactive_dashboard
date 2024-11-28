<?php
// Uncomment the two lines below to Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

// Fetch user permissions
$user_id = $_SESSION['id']; // Assuming user_id is stored in session
$permission_query = "SELECT canedit, candelete, canadd FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

// Check if the user has delete permission
if ($permissions['candelete'] == 0) {
    $_SESSION['delete_message'] = "You do not have permission to delete this bon.";
    header("Location: bons.php");
    exit;
}

if (isset($_POST['company_id']) && is_numeric($_POST['company_id'])) {
    $company_id = mysqli_real_escape_string($link, $_POST['company_id']);

    // SQL query to delete the bon record
    $delete_query = "DELETE FROM bon WHERE id = '$company_id'";

    if (mysqli_query($link, $delete_query)) {
        $_SESSION['delete_message'] = "Bon deleted successfully.";
    } else {
        $_SESSION['delete_message'] = "Error deleting bon: " . mysqli_error($link);
    }
} else {
    $_SESSION['delete_message'] = "Invalid bon ID.";
}

header("Location: bons.php");
exit;
?>
