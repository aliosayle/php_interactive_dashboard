<?php
// Include the config file for database connection
ini_set('display_errors', 1); error_reporting(E_ALL);
include('layouts/config.php');


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get form data
    $autono = $_POST['autono'];
    $reference = $_POST['reference'];
    $sequence_reference = $_POST['sequence_reference'];
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $company_id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $site_id = $_POST['site_id'];
    $date_of_bon = $_POST['date_of_bon'];
    $total_one = $_POST['total_one'];
    $total_two = $_POST['total_two'];
    $currency_one = $_POST['currency_one'];
    $currency_two = $_POST['currency_two'];
    $amount_in_lettres = $_POST['amount_in_lettres'];
    $beneficier_name = $_POST['beneficier_name'];
    $motif = $_POST['motif'];
    $account_number = $_POST['account_number'];
    $is_voided = $_POST['is_voided'];
    $comments = $_POST['comments'];

    // Generate UUID for the id field if it's not set
    $id = null;
    $sql = "SELECT UUID() AS uuid";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id = $row['uuid'];
    }

    // Prepare the SQL statement to insert the data into the database
    $stmt = $link->prepare("INSERT INTO bon (id, autono, reference, sequence_reference, user_id, username, company_id, company_name, site_id, date_of_bon, total_one, total_two, currency_one, currency_two, amount_in_lettres, beneficier_name, motif, account_number, is_voided, comments) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssssdsdsssss", $id, $autono, $reference, $sequence_reference, $user_id, $username, $company_id, $company_name, $site_id, $date_of_bon, $total_one, $total_two, $currency_one, $currency_two, $amount_in_lettres, $beneficier_name, $motif, $account_number, $is_voided, $comments);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Bon</title>
</head>
<body>

<h2>Insert Bon Record</h2>

<form method="POST" action="insert_bon.php">
    <label for="autono">Autono:</label><br>
    <input type="number" id="autono" name="autono" required><br><br>

    <label for="reference">Reference:</label><br>
    <input type="text" id="reference" name="reference" required><br><br>

    <label for="sequence_reference">Sequence Reference:</label><br>
    <input type="text" id="sequence_reference" name="sequence_reference" required><br><br>

    <label for="user_id">User ID:</label><br>
    <input type="text" id="user_id" name="user_id" required><br><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="company_id">Company ID:</label><br>
    <input type="text" id="company_id" name="company_id"><br><br>

    <label for="company_name">Company Name:</label><br>
    <input type="text" id="company_name" name="company_name"><br><br>

    <label for="site_id">Site ID:</label><br>
    <input type="text" id="site_id" name="site_id"><br><br>

    <label for="date_of_bon">Date of Bon:</label><br>
    <input type="date" id="date_of_bon" name="date_of_bon" required><br><br>

    <label for="total_one">Total One:</label><br>
    <input type="number" step="0.01" id="total_one" name="total_one" required><br><br>

    <label for="total_two">Total Two:</label><br>
    <input type="number" step="0.01" id="total_two" name="total_two"><br><br>

    <label for="currency_one">Currency One:</label><br>
    <input type="text" id="currency_one" name="currency_one" required><br><br>

    <label for="currency_two">Currency Two:</label><br>
    <input type="text" id="currency_two" name="currency_two"><br><br>

    <label for="amount_in_lettres">Amount in Lettres:</label><br>
    <textarea id="amount_in_lettres" name="amount_in_lettres" required></textarea><br><br>

    <label for="beneficier_name">Beneficier Name:</label><br>
    <input type="text" id="beneficier_name" name="beneficier_name" required><br><br>

    <label for="motif">Motif:</label><br>
    <input type="text" id="motif" name="motif" required><br><br>

    <label for="account_number">Account Number:</label><br>
    <input type="text" id="account_number" name="account_number"><br><br>

    <label for="is_voided">Is Voided (0 or 1):</label><br>
    <input type="number" id="is_voided" name="is_voided" required><br><br>

    <label for="comments">Comments:</label><br>
    <input type="text" id="comments" name="comments"><br><br>

    <input type="submit" value="Insert Bon">
</form>

</body>
</html>
