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

$response_message = '';
$response_color = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company_id'], $_POST['company_name'])) {
    $company_id = mysqli_real_escape_string($link, $_POST['company_id']);
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);

    // Update the company name in the database
    $update_query = "UPDATE companies SET company_name = '$company_name' WHERE id = '$company_id'";

    if (mysqli_query($link, $update_query)) {
        header('Location: companies.php');

    } else {
        $response_message = 'Error updating company name: ' . mysqli_error($link);
        $response_color = 'red';
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
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Include FontAwesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #sa-params {
            margin-left: 10px;
            /* Adjust this value to your desired spacing */
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
                                    <li class="breadcrumb-item"><a href="dashboard.php"
                                            class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="companies.php"
                                            class="breadcrumb-link">Companies</a></li>
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
                                    <form id="edit-company-form" method="POST" action="" class="d-flex w-100"> <input
                                            type="hidden" name="company_id" id="company_id"
                                            value="<?php echo htmlspecialchars($_POST['company_id'] ?? ''); ?>">
                                        <!-- Textbox takes up 9/12 of the width with some space for padding -->
                                        <div class="form-group mb-0 w-75 pr-2"> <label for="company_name"
                                                class="sr-only">Company Name</label> <input type="text"
                                                name="company_name" id="company_name" class="form-control w-100"
                                                value="<?php echo htmlspecialchars($_POST['company_name'] ?? ''); ?>"
                                                required> </div>
                                        <!-- Button takes up 3/12 of the width with some margin on the left --> <button
                                            type="button" id="sa-params"
                                            class="btn btn-primary btn-sm waves-effect waves-light w-25"> Edit Name
                                        </button>
                                    </form>






                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.getElementById('edit-company-form');
        const companyNameInput = document.getElementById('company_name');

        const showAlert = () => {
            const companyName = companyNameInput.value;

            if (companyName.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Company name cannot be empty!',
                });
                return false;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to update the company name.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

            return false; // Prevent the form from submitting immediately
        };

        document.getElementById('sa-params').addEventListener('click', showAlert);

        form.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default form submission
                showAlert();
            }
        });
    });
</script>



                                    <!-- Feedback message container -->
                                    <?php if ($response_message): ?>
                                        <p id="response-message"
                                            style="font-weight: bold; margin-top: 10px; color: <?php echo $response_color; ?>;">
                                            <?php echo $response_message; ?>
                                        </p>
                                    <?php endif; ?>
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
</body>

</html>