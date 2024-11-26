<?php
// Enable error reporting for debugging
// ini_set('display_errors', 1); // error_reporting(E_ALL);

include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company_name'])) {
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);
    // Insert the company into the database
    $insert_query = "INSERT INTO companies (company_name) VALUES ('$company_name')";

    if (mysqli_query($link, $insert_query)) {
        // Success response
        $response['status'] = 'success';
        $response['message'] = 'New company added successfully.';
    } else {
        // Error response
        $response['status'] = 'error';
        $response['message'] = 'Error adding company: ' . mysqli_error($link);
    }

    // Return the response as JSON
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company | Admin Panel</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

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
                                    <li class="breadcrumb-item active" aria-current="page">Add New Company</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add New Company</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Form to add new company -->
                                    <form id="add-company-form" method="POST" action="">
                                        <div class="form-group mb-3 row">
                                            <div class="col-md-8">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" name="company_name" id="company_name" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary">Add Company</button>
                                            </div>
                                        </div>
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
</div>

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#add-company-form').on('submit', function (e) {
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
