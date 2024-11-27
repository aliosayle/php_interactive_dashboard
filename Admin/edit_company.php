<?php
include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

$response_message = '';
$response_color = '';

session_start();
$user_id = $_SESSION['id'] ?? null;

if (!$user_id) {
    die("User not logged in.");
}

$permission_query = "SELECT canedit FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company_id'], $_POST['company_name'])) {
    if ($permissions['canedit'] != 1) {
        die("You do not have permission to edit company names.");
    }

    $company_id = mysqli_real_escape_string($link, $_POST['company_id']);
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);

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
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Include FontAwesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #sa-params {
            margin-left: 10px;
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
                                    <form id="edit-company-form" method="POST" action="" class="d-flex flex-column w-100"> 
                                        <input type="hidden" name="company_id" id="company_id"
                                            value="<?php echo htmlspecialchars($_POST['company_id'] ?? ''); ?>">
                                        <div class="d-flex align-items-center mb-3 w-100"> 
                                            <div class="form-group w-75 mr-2">
                                                <label for="company_name" class="sr-only">Company Name</label> 
                                                <input type="text" name="company_name" id="company_name" 
                                                    class="form-control w-100"
                                                    value="<?php echo htmlspecialchars($_POST['company_name'] ?? ''); ?>"
                                                    required> 
                                            </div>
                                            <!-- Buttons container -->
                                            <button type="button" id="cancel-btn" 
                                                class="btn btn-secondary btn-sm waves-effect waves-light mr-2">Cancel
                                            </button>
                                            <button type="button" id="sa-params" 
                                                class="btn btn-primary btn-sm waves-effect waves-light">Confirm
                                            </button>
                                        </div>
                                    </form>

                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const form = document.getElementById('edit-company-form');
        const companyNameInput = document.getElementById('company_name');
        const cancelButton = document.getElementById('cancel-btn');

        const confirmUpdate = () => {
            const companyName = companyNameInput.value;

            if (companyName.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Company name cannot be empty!',
                });
                return false;
            }

            form.submit(); // Directly submit the form
        };

        document.getElementById('sa-params').addEventListener('click', confirmUpdate);

        form.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent the default form submission
                confirmUpdate();
            }
        });

        cancelButton.addEventListener('click', () => {
            const companyName = companyNameInput.value;

            if (companyName.trim() !== "") {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will lose any unsaved changes.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'companies.php';
                    }
                });
            } else {
                window.location.href = 'companies.php';
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
