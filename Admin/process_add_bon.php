<?php
// Start session
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database configuration
include 'layouts/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $reference = $_POST['reference'];
    $sequence_reference = $_POST['sequence_reference'];
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $company_id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $site_id = $_POST['site_id'];
    $date_of_bon = $_POST['date'];
    $total_one = $_POST['amoun_1'];
    $currency_one = $_POST['currency_1'];
    $total_two = !empty($_POST['amount_2']) ? $_POST['amount_2'] : null;
    $currency_two = !empty($_POST['currency_2']) ? $_POST['currency_2'] : null;
    $is_voided = ($_POST['isvoided'] == "Yes") ? 1 : 0;
    $comments = $_POST['description'];
    $account_number = $_POST['account_number'];
    $motive = $_POST['motive'];
    $paid_by = $_POST['paid_by'];

    // Format numbers
    $total_one = number_format((float) $total_one, 4, '.', '');
    if (!empty($total_two)) {
        $total_two = number_format((float) $total_two, 4, '.', '');
    }

    function numberToWordsFrench($number)
{
    $hyphen = '-';
    $conjunction = ' et ';
    $separator = ', ';
    $negative = 'moins ';
    $decimal = ' virgule ';
    $dictionary = array(
        0 => 'zéro', 1 => 'un', 2 => 'deux', 3 => 'trois', 4 => 'quatre', 5 => 'cinq', 6 => 'six', 7 => 'sept',
        8 => 'huit', 9 => 'neuf', 10 => 'dix', 11 => 'onze', 12 => 'douze', 13 => 'treize', 14 => 'quatorze',
        15 => 'quinze', 16 => 'seize', 17 => 'dix-sept', 18 => 'dix-huit', 19 => 'dix-neuf', 20 => 'vingt',
        30 => 'trente', 40 => 'quarante', 50 => 'cinquante', 60 => 'soixante', 70 => 'soixante-dix',
        80 => 'quatre-vingt', 90 => 'quatre-vingt-dix', 100 => 'cent', 1000 => 'mille', 1000000 => 'un million',
        1000000000 => 'un milliard'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if ($number < 0) {
        return $negative . numberToWordsFrench(abs($number));
    }

    $string = $fraction = null;

    // Split the number into integer and fraction parts
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    // Convert the integer part
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                if ($tens == 70 || $tens == 90) {
                    $string = $dictionary[$tens - 10] . $hyphen . $dictionary[$units + 10];
                } else {
                    $string .= $hyphen . $dictionary[$units];
                }
            }
            break;
        case $number < 1000:
            $hundreds = (int) ($number / 100);
            $remainder = $number % 100;
            $string = ($hundreds > 1 ? $dictionary[$hundreds] . ' ' : '') . $dictionary[100];
            if ($remainder) {
                $string .= ' ' . numberToWordsFrench($remainder);
            }
            break;
        default:
            foreach (array(1000000000 => 'milliard', 1000000 => 'million', 1000 => 'mille') as $base => $baseWord) {
                if ($number >= $base) {
                    $baseUnits = (int) ($number / $base);
                    $remainder = $number % $base;
                    $string = numberToWordsFrench($baseUnits) . ' ' . $baseWord;
                    if ($remainder) {
                        $string .= $separator . numberToWordsFrench($remainder);
                    }
                    break;
                }
            }
    }

    // Handle fractional part and avoid unnecessary zeros
    if (null !== $fraction && is_numeric($fraction) && $fraction != '0') {
        $string .= $decimal;
        // Remove trailing zeros by converting the fraction to a string and trimming
        $fraction = rtrim($fraction, '0');
        $words = array();
        foreach (str_split((string) $fraction) as $digit) {
            $words[] = $dictionary[$digit];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

    
    

    $amount_in_lettres = '';
    $amount_in_lettres = numberToWordsFrench($total_one) . ' ' . $currency_one
    . "<br>### ### ###<br>"
    . numberToWordsFrench($total_two) . ' ' . $currency_two;
    print(''. $amount_in_lettres);

    if (!empty($total_two)) {
        $amount_in_lettres = numberToWordsFrench($total_one) . ' ' . $currency_one
            . "\n### ### ###\n"
            . numberToWordsFrench($total_two) . ' ' . $currency_two;
    } else {
        $amount_in_lettres = numberToWordsFrench($total_one) . ' ' . $currency_one;
    }

    try {
        // Prepare SQL insert query
        $sql = "INSERT INTO bon 
                (reference, sequence_reference, user_id, username, company_id, company_name, site_id, date_of_bon, 
                total_one, total_two, currency_one, currency_two, amount_in_lettres, beneficier_name, motif, account_number, 
                is_voided, comments) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        
// Get actual values from $_POST or use them directly in the print statement
$reference = $_POST['reference'];
$sequence_reference = $_POST['sequence_reference'];
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$company_id = $_POST['company_id'];
$company_name = $_POST['company_name'];
$site_id = $_POST['site_id'];
$date_of_bon = $_POST['date'];
$total_one = $_POST['amoun_1'];
$currency_one = $_POST['currency_1'];
$total_two = !empty($_POST['amount_2']) ? $_POST['amount_2'] : null;
$currency_two = !empty($_POST['currency_2']) ? $_POST['currency_2'] : null;
$is_voided = ($_POST['isvoided'] == "Yes") ? 1 : 0;
$comments = $_POST['description'];
$account_number = $_POST['account_number'];
$motive = $_POST['motive'];
$paid_by = $_POST['paid_by'];
$amount_in_lettres = ''; 

$sql = "INSERT INTO bon 
        (reference, sequence_reference, user_id, username, company_id, company_name, site_id, date_of_bon, 
        total_one, total_two, currency_one, currency_two, amount_in_lettres, beneficier_name, motif, account_number, 
        is_voided, comments) 
        VALUES ('$reference', '$sequence_reference', '$user_id', '$user_name', '$company_id', '$company_name', 
        '$site_id', '$date_of_bon', '$total_one', '$total_two', '$currency_one', '$currency_two', 
        '$amount_in_lettres', '$comments', '$motive', '$account_number', '$is_voided', '$paid_by')";


if (mysqli_query($link, $sql)) {
    echo "Record inserted successfully!";
    header("Location: bons.php");
} else {
    echo "Error: " . mysqli_error($link);
}


    } catch (Exception $e) {
        // Handle errors
        die("Error: " . $e->getMessage());
    }
}
?>