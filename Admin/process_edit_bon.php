<?php
include 'layouts/session.php';
include 'layouts/config.php'; // Make sure this file contains your DB connection details
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get the values from the POST request
    $id = mysqli_real_escape_string($link, $_POST['id']);
    $reference = mysqli_real_escape_string($link, $_POST['reference']);
    $sequence_reference = mysqli_real_escape_string($link, $_POST['sequence_reference']);
    $user_id = mysqli_real_escape_string($link, $_POST['user_id']);
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);
    $total_one = mysqli_real_escape_string($link, $_POST['total_one']);
    $currency_one = mysqli_real_escape_string($link, $_POST['currency_one']);
    $amount_2 = mysqli_real_escape_string($link, $_POST['amount_2']);
    $currency_2 = mysqli_real_escape_string($link, $_POST['currency_2']);
    $is_voided = mysqli_real_escape_string($link, $_POST['is_voided']);
    $date_of_bon = mysqli_real_escape_string($link, $_POST['date_of_bon']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $site_name = mysqli_real_escape_string($link, $_POST['site_name']);
    $comments = mysqli_real_escape_string($link, $_POST['description']);
    $account_number = mysqli_real_escape_string($link, $_POST['account_number']);
    $motif = mysqli_real_escape_string($link, $_POST['motif']);
    $beneficier_name = mysqli_real_escape_string($link, $_POST['beneficier_name']);

    // Prepare the SQL update query
    $update_query = "UPDATE bon SET 
        reference = '$reference',
        sequence_reference = '$sequence_reference',
        user_id = '$user_id',
        company_id = '$company_name',
        total_one = '$total_one',
        currency_one = '$currency_one',
        total_two = '$amount_2',
        currency_two = '$currency_2',
        is_voided = '$is_voided',
        date_of_bon = '$date_of_bon',
        username = '$username',
        comments = '$comments',
        account_number = '$account_number',
        motif = '$motif',
        beneficier_name = '$beneficier_name'
    WHERE id = '$id'";

    // Execute the query and check if the update was successful
    if (mysqli_query($link, $update_query)) {
        // Redirect to the page where you want to show the success message or the updated data
        header("Location: bons.php?message=Bon updated successfully");
    } else {
        // Handle the error if the query fails
        echo "Error updating record: " . mysqli_error($link);
    }
} else {
    // If the form is not submitted, redirect back to the edit page with an error message
    header("Location: edit_bon.php?bon_id=" . $_POST['id'] . "&error=Invalid request");
}

mysqli_close($link); // Close the database connection
?>
