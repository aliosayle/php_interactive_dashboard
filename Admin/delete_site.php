<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    $_SESSION['delete_message'] = "You must be logged in to delete a site.";
    header("Location: sites_table.php");
    exit();
}

// Fetch user permissions
$user_id = $_SESSION['id'];
$permission_query = "SELECT candelete FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && $permissions['candelete'] == 1) {
    $site_id = mysqli_real_escape_string($link, $_GET['id']);
    
    $delete_query = "DELETE FROM sites WHERE id = '$site_id'";
    if (mysqli_query($link, $delete_query)) {
        $_SESSION['delete_message'] = "site deleted successfully.";
    } else {
        $_SESSION['delete_message'] = "Error deleting site: " . mysqli_error($link);
    }
} else {
    $_SESSION['delete_message'] = "You do not have permission to delete sites.";
}

header("Location: sites.php");
exit();
?>