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
    $_SESSION['delete_message'] = "You must be logged in to delete a company.";
    header("Location: companies_table.php");
    exit();
}

// Fetch user permissions
$user_id = $_SESSION['id'];
$permission_query = "SELECT candelete FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && $permissions['candelete'] == 1) {
    $company_id = mysqli_real_escape_string($link, $_GET['id']);
    
    $delete_query = "DELETE FROM companies WHERE id = '$company_id'";
    if (mysqli_query($link, $delete_query)) {
        $_SESSION['delete_message'] = "Company deleted successfully.";
    } else {
        $_SESSION['delete_message'] = "Error deleting company: " . mysqli_error($link);
    }
} else {
    $_SESSION['delete_message'] = "You do not have permission to delete companies.";
}

header("Location: companies.php");
exit();
?>