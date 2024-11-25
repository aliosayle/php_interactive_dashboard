<?php
include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company_name'])) {
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);

    // Insert the company into the database
    $insert_query = "INSERT INTO companies (company_name) VALUES ('$company_name')";
    if (mysqli_query($link, $insert_query)) {
        echo "<script>alert('New company added successfully'); window.location.href='companies_list.php';</script>";
    } else {
        echo "<script>alert('Error adding company: " . mysqli_error($link) . "');</script>";
    }
}
?>

<head>
    <title>Add Company | Minia - Admin & Dashboard Template</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; ?>

<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add New Company</h4>
                            </div>
                            <div class="card-body">
                                <!-- Form to add new company -->
                                <form method="POST" action="">
                                    <div class="form-group mb-3">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Company</button>
                                </form>
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
</body>
</html>
