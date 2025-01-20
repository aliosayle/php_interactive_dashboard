<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include('layouts/config.php');

?>

<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuration and session handling
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_submitted'])) {
    $name = $_POST['name'];
    $type = $_POST['type'];

    $insert_sql = "INSERT INTO companies (name) 
                   VALUES (?)";
    if ($stmt = $link->prepare($insert_sql)) {
        $stmt->bind_param("s", $name, $type);
        $stmt->execute();
        $stmt->close();
    }
    $link->close();
    header("Location: companies.php");
    exit;
}
?>

<head>
    <title>Add Bon | Admin Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="company-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Login</li>
                                <li class="breadcrumb-item"><a href="companies.php">Companys</a></li>
                                <li class="breadcrumb-item active">Add New Company</li>
                            </ol>
                        </div>
                        <br>
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Add New Company</h4>


                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Company Details</h4>
                                <p class="card-title-desc">Please fill in the following details to create a new
                                    Company.</p>
                            </div>
                            <div class="card-body p-4">

                                <form method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <input type="hidden" name="form_submitted" value="1">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" name="name" id="name" required>
                                            </div>

                                        </div>
                                    </div>

                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- company-fluid -->
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select a site",
            allowClear: true
        });
    });
</script>

<script src="assets/js/app.js"></script>

</body>

</html>