<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

// Retrieve and validate company ID from GET parameters
$company_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$company_id) {
    // If no valid ID, set an error message and redirect back
    $_SESSION['delete_message'] = 'Invalid company ID.';
    header('Location: companies.php');
    exit;
}

// Prepare and execute delete query
$delete_query = "DELETE FROM companies WHERE id = ?";
$stmt = mysqli_prepare($link, $delete_query);
mysqli_stmt_bind_param($stmt, "i", $company_id);

if (mysqli_stmt_execute($stmt)) {
    // If the deletion is successful, set a success message
    $_SESSION['delete_message'] = 'Company deleted successfully.';
} else {
    // If deletion fails, set an error message with details
    $_SESSION['delete_message'] = 'Error deleting company: ' . mysqli_error($link);
}

// Redirect back to companies page
header('Location: companies.php');
exit;
?>
