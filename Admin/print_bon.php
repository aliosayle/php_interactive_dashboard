<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include mPDF library
require_once __DIR__ . '/../vendor/autoload.php';
require "layouts/config.php";
use Mpdf\Mpdf;

try {
    // Initialize mPDF

        $mpdf = new Mpdf([
            'tempDir' => '/tmp/mpdf', // Custom temporary directory
        ]);

    // HTML content
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>PDF Example</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12pt;
            }
            .page {
                position: relative;
                width: 794px;
                height: 1123px;
                border: 1px solid #000;
                margin: 0 auto;
            }
            .s11 {
                border: 1px solid black;
            }
            .s12 {
                color: black;
                font: 13pt Arial;
                text-align: center;
                vertical-align: top;
                line-height: 19px;
                padding-top: 1px;
            }
            .s13 {
                color: black;
                font: bold 13pt Arial;
                vertical-align: top;
                line-height: 19px;
                padding-top: 1px;
                padding-left: 2px;
            }
            .s14 {
                color: black;
                font: 13pt Arial;
                vertical-align: top;
                line-height: 19px;
                padding-top: 1px;
                padding-left: 2px;
            }
            .s15 {
                border-bottom: 1px dotted black;
            }
            .s16 {
                color: black;
                font: bold 13pt Arial;
                text-align: center;
                vertical-align: top;
                line-height: 19px;
                padding-top: 1px;
            }
        </style>
    </head>
    <body>
        <div id="page1" class="page">
            <div style="left:39px;top:39px;width:717px;height:1046px;"></div>
            <div class="s11" style="left:38px;top:38px;width:717px;height:1046px;"></div>
            <div class="s12" style="left:191px;top:57px;width:412px;height:25px;"><b>BON A PAYER Nº</b> &nbsp;ACC24-4</div>
            <div class="s13" style="left:77px;top:113px;width:44px;height:18px;">Sté :</div>
            <div class="s14" style="left:125px;top:113px;width:261px;height:18px;">IPC</div>
            <div class="s15" style="left:125px;top:113px;width:263px;height:19px;"></div>
            <div class="s13" style="left:404px;top:113px;width:44px;height:18px;">Site :</div>
            <div class="s14" style="left:452px;top:113px;width:260px;height:18px;">USINE SAVON</div>
            <div class="s15" style="left:452px;top:113px;width:262px;height:19px;"></div>
            <div class="s13" style="left:87px;top:189px;width:111px;height:18px;">Order Ref # :</div>
            <div class="s12" style="left:202px;top:189px;width:180px;height:18px;">DC2300</div>
            <div class="s15" style="left:202px;top:189px;width:180px;height:19px;"></div>
            <div class="s13" style="left:68px;top:227px;width:164px;height:25px;">Numéro de Compt :</div>
            <div class="s15" style="left:236px;top:227px;width:146px;height:19px;"></div>
            <div class="s13" style="left:548px;top:155px;width:55px;height:18px;">Date :</div>
            <div class="s12" style="left:607px;top:155px;width:111px;height:18px;">25/04/2024</div>
            <div class="s15" style="left:607px;top:155px;width:111px;height:19px;"></div>
            <div class="s13" style="left:423px;top:204px;width:85px;height:18px;">Montant :</div>
            <div class="s12" style="left:519px;top:198px;width:142px;height:24px;">##<b>75,080.00</b>##</div>
            <div class="s11" style="left:518px;top:197px;width:142px;height:25px;"></div>
        </div>
    </body>
    </html>
    ';

    // Write the HTML to mPDF
    $mpdf->WriteHTML($html);

    // Output to browser
    $mpdf->Output('generated_pdf.pdf', 'I'); // 'I' for inline display
} catch (\Mpdf\MpdfException $e) {
    echo 'PDF generation error: ' . $e->getMessage();
}
