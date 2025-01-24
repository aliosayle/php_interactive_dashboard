<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Static BON Page</title>

    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 0;
            }

            .print-button {
                display: none;
            }
        }

        /* Remove the global absolute positioning rule */
        /* div, img, table { position: absolute; } */

        /* Apply absolute positioning only to specific elements */
        .s11, .s12, .s13, .s14, .s15, .s16, .s17, .s18 {
            position: absolute;
        }

        div,
        td {
            overflow: hidden;
        }

        sub {
            font-size: 0.67em;
        }

        sup {
            font-size: 0.67em;
            vertical-align: top;
            position: relative;
            top: -0.2em;
        }

        svg {
            vertical-align: top;
        }

        tr,
        td,
        table,
        tbody {
            text-decoration: inherit;
            vertical-align: inherit;
        }

        table {
            width: 100%;
            height: 100%;
            border-spacing: 0;
        }

        .nav {
            font-family: Courier New, monospace;
            font-size: 16;
            font-weight: bold;
            margin: 1em;
        }

        .nav a {
            text-decoration: none;
            margin-right: 1em;
            color: black;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        .page {
            /* border: 0.5mm solid black; */
            margin: 5mm;
            border-radius: 2mm;
            position: relative; /* Ensure child elements with absolute positioning are relative to this container */
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

        .s17 {
            border-left: 1px solid black;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }

        .s18 {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
    </style>
</head>
<body>
    <!-- Modal content structure -->
    <div id="page1" class="page" style="position:relative;width:794px;height:1123px">
        <div class="s11" style="left:38px;top:38px;width:717px;height:1046px;"></div>
        
        <div class="s12" style="left:191px;top:57px;width:412px;height:25px;">
            <b>BON A PAYER Nº</b><u> &nbsp;REF12345</u>
        </div>

        <div class="s13" style="left:77px;top:113px;width:44px;height:18px;">Sté :</div>
        <div class="s14" style="left:125px;top:113px;width:261px;height:18px;">
            <u>Example Company</u>
        </div>

        <div class="s13" style="left:404px;top:113px;width:44px;height:18px;">Site :</div>
        <div class="s14" style="left:452px;top:113px;width:260px;height:18px;">
            <u>Example Site</u>
        </div>

        <div class="s13" style="left:87px;top:189px;width:111px;height:18px;">Order Ref # :</div>
        <div class="s12" style="left:202px;top:189px;width:180px;height:18px;">
            ORD12345
        </div>

        <div class="s13" style="left:68px;top:227px;width:164px;height:25px;">Numéro de Compt :</div>
        <div class="s15" style="left:236px;top:227px;width:146px;height:19px;">
            123456789
        </div>

        <div class="s13" style="left:548px;top:155px;width:55px;height:18px;">Date :</div>
        <div class="s12" style="left:607px;top:155px;width:111px;height:18px;">
            2023-10-01
        </div>

        <div class="s13" style="left:423px;top:204px;width:85px;height:18px;">Montant :</div>
        <div class="s12" style="left:519px;top:198px;width:142px;height:24px;">
            ##<b>1000.00</b>##
        </div>
        <div class="s16" style="left:662px;top:198px;width:56px;height:24px;">
            USD
        </div>

        <div class="s12" style="left:519px;top:228px;width:142px;height:24px;">
            ##<b>#######</b>##
        </div>
        <div class="s16" style="left:662px;top:228px;width:56px;height:24px;">
            ##
        </div>

        <div class="s13" style="left:68px;top:299px;width:176px;height:17px;">Nom du Bénéficiare :</div>
        <div class="s14" style="left:248px;top:299px;width:468px;height:17px;">
            <u>John Doe</u>
        </div>

        <div class="s13" style="left:68px;top:340px;width:176px;height:18px;">Montant en lettres :</div>
        <div class="s14" style="left:248px;top:340px;width:466px;height:94px;">
            <u> ##One Thousand Dollars##</u>
        </div>

        <div class="s13" style="left:68px;top:461px;width:176px;height:18px;">Motif :</div>
        <div class="s14" style="left:248px;top:461px;width:466px;height:75px;">
            <u>Payment for services rendered</u>
        </div>

        <div class="s13" style="left:68px;top:548px;width:176px;height:18px;">Commentaires :</div>
        <div class="s14" style="left:248px;top:548px;width:466px;height:75px;">
            No additional comments.
        </div>

        <div class="s16" style="left:39px;top:953px;width:239px;height:131px;">NOM ET SIGNATURE<br />EMITTEUR</div>
        <div class="s17" style="left:38px;top:952px;width:239px;height:132px;"></div>
        <div class="s16" style="left:277px;top:953px;width:238px;height:131px;">NOM ET SIGNATURE<br />AUTORITAIRE</div>
        <div class="s11" style="left:276px;top:952px;width:238px;height:132px;"></div>
        <div class="s16" style="left:514px;top:953px;width:243px;height:131px;">NOM ET SIGNATURE<br />FINANCIERE</div>
        <div class="s18" style="left:514px;top:952px;width:243px;height:132px;"></div>
    </div>
</body>
</html>