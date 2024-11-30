<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include mPDF library
require_once __DIR__ . '/../vendor/autoload.php';
require "layouts/config.php";

// Get the bon_id from the request
if (isset($_POST['bon_id'])) {
    $bon_id = $_POST['bon_id'];

    // Query to fetch the bon details
    $query = "SELECT * FROM bon WHERE id = '$bon_id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        // Prepare the content for printing
        $content = "
        <style>
            body {
                font-family: 'Arial', sans-serif;
                color: #333;
                margin: 0;
                padding: 0;
                border: 2px solid #000; /* Add a border around the page */
                height: 100%;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }
            .container {
                width: 100%;
                height: 100%;
                padding: 10px;
                box-sizing: border-box;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                position: relative; /* Allows absolute positioning for signature section */
            }
            .header {
                text-align: center;
                font-size: 32px;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .bon-details {
                flex-grow: 1;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                border: none;
            }
            th, td {
                padding: 15px;
                border: 1px solid #ddd;
                text-align: left;
                font-size: 14px; /* Adjust the font size for better readability */
                text-decoration: underline; /* Underline all table fields */
            }
            .signature-section {
                position: absolute;
                bottom: 10px; /* Ensures the signature section is at the bottom of the page */
                width: 100%;
                text-align: center;
            }
            .signature-table {
                width: 100%;
                border-top: 1px solid #000;
                margin-top: 20px;
            }
            .signature-table td {
                text-align: center;
                width: 33%; /* Equal column widths */
                padding-top: 30px;
                font-size: 16px;
            }
        </style>
        <div class='container'>
            <div class='header'>Bon à Payer N° " . htmlspecialchars($row['reference']) . "</div>
            <div class='bon-details'>
                <table>
                <tr><th>Sté</th><td>AFRIFOOD</td><th>Site</th><td>" . htmlspecialchars(mysqli_fetch_assoc(mysqli_query($link, "SELECT site_name FROM sites WHERE id = '" . mysqli_real_escape_string($link, $row['site_id']) . "'"))['site_name'] ?? 'Unknown') . "</td></tr>
                    <tr><th>Order Ref #</th><td>" . htmlspecialchars($row['reference']) . "</td><th>Date</th><td>" . htmlspecialchars($row['date_of_bon']) . "</td></tr>
                    <tr><th>Numéro de Compte</th><td>" . htmlspecialchars($row['account_number']) . "</td><th>Montant</th>
                        <td>
                            <table>
                                <tr>
                                    <td><b>##" . htmlspecialchars($row['total_one']) . "##</b></td>
                                    <td>" . htmlspecialchars($row['currency_one']) . "</td>
                                </tr>
                                <tr>
                                    <td><b>##" . htmlspecialchars($row['total_two']) . "##</b></td>
                                    <td>" . htmlspecialchars($row['currency_two']) . "</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr><th>Nom du Bénéficiaire</th><td colspan='3'>" . htmlspecialchars($row['beneficier_name']) . "</td></tr>
                    <tr><th>Montant en lettres</th><td colspan='3'>" . htmlspecialchars($row['amount_in_lettres']) . "</td></tr>
                    <tr><th>Motif</th><td colspan='3'>" . htmlspecialchars($row['motif']) . "</td></tr>
                    <tr><th>Commentaires</th><td colspan='3'>" . htmlspecialchars($row['comments']) . "</td></tr>
                </table>
            </div>
            <div class='signature-section'>
                <table class='signature-table'>
                    <tr>
                        <td>NOM ET SIGNATURE EMETTEUR</td>
                        <td>NOM ET SIGNATURE AUTORITAIRE</td>
                        <td>NOM ET SIGNATURE FINANCIÈRE</td>
                    </tr>
                </table>
            </div>
        </div>
    ";

        // Initialize mPDF with custom temporary directory
        $tempDir = __DIR__ . '/../tmp/mpdf';  // Modify the path as necessary
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => $tempDir
        ]);

        // Write content to PDF
        $mpdf->WriteHTML($content);

        // Output the PDF
        $mpdf->Output('bon_details.pdf', 'I'); // 'I' will display the PDF in the browser
    } else {
        echo "Bon not found.";
    }
}
?>