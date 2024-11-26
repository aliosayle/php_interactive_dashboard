<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company_id'], $_POST['company_name'])) {
    $company_id = mysqli_real_escape_string($link, $_POST['company_id']);
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);
    
    // Debugging step: Check form values
    echo 'Company ID: ' . $company_id . '<br>';
    echo 'Company Name: ' . $company_name . '<br>';

    // Update the company name in the database
    $update_query = "UPDATE companies SET company_name = '$company_name' WHERE id = '$company_id'";

    if (mysqli_query($link, $update_query)) {
        // Success response
        $response['status'] = 'success';
        $response['message'] = 'Company name updated successfully.';
    } else {
        // Error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating company name: ' . mysqli_error($link);
    }

    // Return the response as JSON
    echo json_encode($response);
    exit;
} else {
    // Debugging step: Check if POST data is not set correctly
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo 'Form data missing: ';
        if (!isset($_POST['company_id'])) {
            echo 'company_id ';
        }
        if (!isset($_POST['company_name'])) {
            echo 'company_name';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company | Minia - Admin & Dashboard Template</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Include FontAwesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Add CSS to center the alert message -->
    <style>
        #alert-container {
            position: fixed;
            top: 50%;
            left: 50%;
            z-index: 9999;
            transform: translate(-50%, -50%);
            width: 50%;
            min-width: 300px;
        }

        .alert {
            padding: 20px;
            font-size: 16px;
            max-width: 100%;
        }

        .form-inline {
            display: flex;
            align-items: center;
        }

        .form-inline .form-group {
            flex-grow: 1;
            margin-right: 10px;
        }

        .form-inline .form-control {
            width: 100%;
        }

        .form-inline .btn {
            white-space: nowrap;
            height: calc(1.5em + 0.75rem + 2px);
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
                    <!-- Breadcrumb -->
                    <div class="row">
                        <div class="col-12">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="companies.php" class="breadcrumb-link">Companies</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Company</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Company</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Form to edit company name -->
                                    <form id="edit-company-form" method="POST" action="" class="form-inline">
                                        <input type="hidden" name="company_id" id="company_id" value="">
                                        <div class="form-group">
                                            <label for="company_name" class="sr-only">Company Name</label>
                                            <input type="text" name="company_name" id="company_name" class="form-control mb-3" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3">Update Company</button>
                                    </form>

                                    <!-- Container to display the alert -->
                                    <div id="alert-container" class="mt-3"></div>
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

    <script src="assets/js/app.js"></script>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            // Set company details in the form if editing
            const companyId = "<?php echo isset($_POST['company_id']) ? htmlspecialchars($_POST['company_id']) : ''; ?>";
            const companyName = "<?php echo isset($_POST['company_name']) ? htmlspecialchars($_POST['company_name']) : ''; ?>";
            $('#company_id').val(companyId);
            $('#company_name').val(companyName);

            $('#edit-company-form').on('submit', function (e) {
                e.preventDefault();
                const formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        let alertBox;
                        if (response.status === 'success') {
                            alertBox = `<div class="col-sm-12">
                                            <div class="alert alert-success alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                                <i class="mdi mdi-check-circle-outline d-block display-4 mt-2 mb-3 text-success"></i>
                                                <h5 class="text-success">Success</h5>
                                                <p>${response.message}</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>`;
                        } else {
                            alertBox = `<div class="col-sm-12">
                                            <div class="alert alert-danger alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                                <i class="mdi mdi-block-helper d-block display-4 mt-2 mb-3 text-danger"></i>
                                                <h5 class="text-danger">Error</h5>
                                                <p>${response.message}</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>`;
                        }
                        $('#alert-container').html(alertBox);
                    },
                    error: function () {
                        const alertBox = `<div class="col-sm-12">
                                            <div class="alert alert-danger alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                                <i class="mdi mdi-block-helper d-block display-4 mt-2 mb-3 text-danger"></i>
                                                <h5 class="text-danger">Error</h5>
                                                <p>An error occurred while processing your request.</p>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>`;
                        $('#alert-container').html(alertBox);
                    }
                });
            });
        });
    </script>
</body>

</html>
