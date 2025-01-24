<?php
// uncomment the two lines below to Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

// Define translation array
$translations = [
    'en' => [
        'dashboard' => 'Dashboard',
        'companies' => 'Companies',
        'companies_table' => 'Companies Table',
        'add_new_bon' => 'Add New bonne',
        'reference' => 'Reference',
        'site_name' => 'Site Name',
        'date_of_bon' => 'Date of Bon',
        'total_one' => 'Total One',
        'total_two' => 'Total Two',
        'currency_one' => 'Currency One',
        'currency_two' => 'Currency Two',
        'amount_in_lettres' => 'Amount in Lettres',
        'beneficier_name' => 'Beneficier Name',
        'motif' => 'Motif',
        'account_number' => 'Account Number',
        'is_voided' => 'Is Voided',
        'comments' => 'Comments',
        'actions' => 'Actions',
        'no_data_found' => 'No data found',
        'bons' => 'Bons',
        'id' => 'id'
    ],
    'fr' => [
        'dashboard' => 'Tableau de bord',
        'companies' => 'Entreprises',
        'companies_table' => 'Tableau des entreprises',
        'add_new_bon' => 'Ajouter une nouvelle bon',
        'reference' => 'Référence',
        'site_name' => 'Nom du site',
        'date_of_bon' => 'Date de bon',
        'total_one' => 'Total Un',
        'total_two' => 'Total Deux',
        'currency_one' => 'Monnaie Un',
        'currency_two' => 'Monnaie Deux',
        'amount_in_lettres' => 'Montant en lettres',
        'beneficier_name' => 'Nom du bénéficiaire',
        'motif' => 'Motif',
        'account_number' => 'Numéro de compte',
        'is_voided' => 'Est annulé',
        'comments' => 'Commentaires',
        'actions' => 'Actions',
        'no_data_found' => 'Aucune donnée trouvée',
        'bons' => 'Bons',
        'id' => 'id'
    ]
];

// Set the default language
$lang = isset($_SESSION['lang']) && in_array($_SESSION['lang'], ['en', 'fr']) ? $_SESSION['lang'] : 'en';

// Replace text based on the selected language
function translate($key, $lang)
{
    global $translations;
    return $translations[$lang][$key] ?? $translations['en'][$key]; // Fallback to English if key is not found
}

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['delete_message'])) {
    $alert_type = strpos($_SESSION['delete_message'], 'successfully') !== false ? 'success' : 'danger';
    echo "<div class='alert alert-$alert_type alert-dismissible fade show' role='alert'>" . htmlspecialchars($_SESSION['delete_message']) . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    unset($_SESSION['delete_message']); // Unset after displaying the message
}

// Fetch user permissions
$user_id = $_SESSION['id']; // Assuming user_id is stored in session
$permission_query = "SELECT canedit, candelete, canadd FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

// Protect POST actions with permission checks
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bon_name']) && $permissions['canadd'] == 1) {
    $bon_name = mysqli_real_escape_string($link, $_POST['bon_name']);
    $insert_query = "INSERT INTO bon (bon_name) VALUES ('$bon_name')";
    if (mysqli_query($link, $insert_query)) {
        echo "<script>alert('New bon added successfully');</script>";
    } else {
        echo "<script>alert('Error adding bon: " . mysqli_error($link) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bons Table</title>

    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.3.2/css/fixedHeader.dataTables.min.css">
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <style>
        .modal-backdrop {
    z-index: 1040 !important;
}

.modal {
    z-index: 1050 !important;
}

    </style>
</head>

<body>
    <?php include 'layouts/body.php'; ?>

    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-3">
                                    <li class="breadcrumb-item">Login</li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?php echo translate('bons', $lang); ?>
                                    </li>
                                </ol>
                            </nav>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Bons</h4>
                                </div>
                                <div class="card-body">
                                <!-- <form method="POST" action="add_bon.php" class="mb-4">
                                    <button type="submit" class="btn btn-primary" <?php if ($permissions['canadd'] == 0) echo 'style="pointer-events: none; opacity: 0.6;"'; ?>>
                                        <i class="fas fa-plus me-2"></i> Add Bon
                                    </button>
                                </form> -->
                <!-- Modal -->
                <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printModalLabel">Print Bon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="printModalBody">
                <!-- Content from design.php will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printModalContent()">Print</button>
            </div>
        </div>
    </div>
</div>

                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th><?php echo translate('reference', $lang); ?></th>
                                                    <th><?php echo translate('beneficier_name', $lang); ?></th>
                                                    <th><?php echo translate('date_of_bon', $lang); ?></th>
                                                    <th><?php echo translate('total_one', $lang); ?></th>
                                                    <th><?php echo translate('total_two', $lang); ?></th>
                                                    <th><?php echo translate('currency_one', $lang); ?></th>
                                                    <th><?php echo translate('currency_two', $lang); ?></th>
                                                    <th><?php echo translate('site_name', $lang); ?></th>
                                                    <th>Company Name</th>
                                                    <th><?php echo translate('motif', $lang); ?></th>
                                                    <th><?php echo translate('account_number', $lang); ?></th>
                                                    <th><?php echo translate('is_voided', $lang); ?></th>
                                                    <th><?php echo translate('comments', $lang); ?></th>
                                                    <th><?php echo translate('actions', $lang); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM bon ORDER BY 'created_at' DESC"; // Query to fetch all data from the 'bon' table
                                                $result = mysqli_query($link, $query);
                                                if (!$result) {
                                                    die("Query failed: " . mysqli_error($link));
                                                }
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<tr>";
                                                        echo "<td>" . htmlspecialchars($row['reference']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['beneficier_name']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['date_of_bon']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['total_one']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['total_two']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['currency_one']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['currency_two']) . "</td>";
                                                        echo "<td>" . htmlspecialchars(mysqli_fetch_assoc(mysqli_query($link, "SELECT name FROM sites WHERE id='" . mysqli_real_escape_string($link, $row['site_id']) . "'"))['name']) . "</td>";
                                                        echo "<td>" . htmlspecialchars(mysqli_fetch_assoc(mysqli_query($link, "SELECT name FROM companies WHERE id='" . mysqli_real_escape_string($link, $row['company_id']) . "'"))['name']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['motif']) . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['account_number']) . "</td>";
                                                        echo "<td>" . ($row['is_voided'] == 1 ? 'Yes' : 'No') . "</td>";
                                                        echo "<td>" . htmlspecialchars($row['comments']) . "</td>";
                                                        echo "<td>";

                                                        // Edit Button with FontAwesome icon
                                                        echo "<form method='GET' action='edit_bon.php' style='display:inline-block;'>";
                                                        echo "<input type='hidden' name='bon_id' value='" . htmlspecialchars($row['id']) . "'>";
                                                        echo "<button type='submit' class='btn btn-sm btn-info' " . ($permissions['canedit'] == 0 ? 'disabled' : '') . "><i class='fas fa-pencil-alt'></i></button>";
                                                        echo "</form>";

                                                        // Delete Button with FontAwesome icon
                                                        echo "<form method='GET' action='delete_bon.php' style='display:inline-block;' class='delete-form'>";
                                                        echo "<input type='hidden' name='bon_id' value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>";
                                                        echo "<button type='button' class='btn btn-sm btn-danger delete-btn' onclick='confirmDelete(this)'>";
                                                        echo "<i class='fas fa-trash-alt'></i>";
                                                        echo "</button>";
                                                        echo "</form>";
                                                                                                          
                                                        


                                                        // Print Button with FontAwesome icon
                                                        echo "<button type='button' class='btn btn-sm btn-secondary print-btn' data-bon-id='" . htmlspecialchars($row['id']) . "'><i class='fas fa-print'></i></button>";


                                                        echo  "</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='14' class='text-center'>" . translate('no_data_found', $lang) . "</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'layouts/footer.php'; ?>

    </div>

    <?php include 'layouts/vendor-scripts.php'; ?>

    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <!-- uncomment the line below to make the table rows expandable -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/js/pages/dashboard.init.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/1.6.2/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js"></script>


    <script>
$('#datatable').DataTable({
    "dom": '<"top"Bfr>ltip',
    "buttons": [
        {
            "extend": 'collection',
            "text": 'Export',
            "buttons": [
                'copy',
                'csv',
                'excel',
                'pdf'
            ]
        }
    ],
    "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
    "columnDefs": [
        {
            "targets": '_all',
            "width": "150px",
            "className": "dt-center"
        }
    ],
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": "fetch_bons.php", // Path to your PHP script
        "type": "POST",
        "data": function(d) {
            // Use the search term provided by DataTables
            d.searchValue = d.search.value; // Pass search value (d.search.value) directly
        }
    },
    "columns": [
        { "data": "reference" },
        { "data": "beneficier_name" },
        { "data": "date_of_bon" },
        { "data": "total_one" },
        { "data": "total_two" },
        { "data": "currency_one" },
        { "data": "currency_two" },
        { "data": "site_name" },
        { "data": "company_name" },
        { "data": "motif" },
        { "data": "account_number" },
        { "data": "is_voided" },
        { "data": "comments" },
        { "data": "actions" }
    ],
    "fixedHeader": true // Enable sticky headers
});


</script>

<script>
    $(document).ready(function () {
        // Handle print button click
        $(document).on('click', '.print-btn', function () {
            var bonId = $(this).data('bon-id'); // Get the bon ID from the button

            // Fetch content from design.php using AJAX
            $.ajax({
                url: 'design.php',
                type: 'GET',
                data: { bon_id: bonId }, // Pass the bon ID to design.php
                success: function (response) {
                    $('#printModalBody').html(response); // Load the response into the modal body
                    $('#printModal').modal('show'); // Show the modal
                },
                error: function () {
                    alert('Error loading print content.');
                }
            });
        });

        // Function to print the modal content
        function printModalContent() {
            var printContents = document.getElementById('printModalBody').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // Reload the page to restore the original content
        }

        // Function to dismiss the modal
        function dismissModal() {
            $('#printModal').modal('hide'); // Hide the modal using Bootstrap's method
        }

        // Print and dismiss modal after printing
        function printAndDismissModal() {
            printModalContent();
            dismissModal();
        }

        // Attach the printAndDismissModal function to the Print button
        $(document).on('click', '#printModal .btn-primary', function () {
            printAndDismissModal();
        });
    });
</script>

<script>
    function confirmDelete(button) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Find the parent form and submit it
                button.closest('form').submit();
            }
        });
    }
</script>



    <link rel="stylesheet" href="styles.css">

</body>

</html>