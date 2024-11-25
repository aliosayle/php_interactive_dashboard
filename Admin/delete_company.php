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

$company_id = isset($_GET['id']) ? $_GET['id'] : '';

if (!$company_id) {
    die("Company ID is missing.");
}

// Delete company record
$delete_query = "DELETE FROM companies WHERE id = ?";
$stmt = mysqli_prepare($link, $delete_query);
mysqli_stmt_bind_param($stmt, "i", $company_id);

if (mysqli_stmt_execute($stmt)) {
    // Set session variable to indicate success
    $_SESSION['delete_message'] = 'Company deleted successfully';
} else {
    // Set session variable to indicate error
    $_SESSION['delete_message'] = 'Error deleting company: ' . mysqli_error($link);
}

// Output JavaScript to show alert and redirect after dismissal
echo "<script type='text/javascript'>
        alert('" . $_SESSION['delete_message'] . "');
        window.location.href = 'companies.php';
      </script>";
exit;
?>
