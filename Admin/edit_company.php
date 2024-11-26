<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'layouts/session.php';
include 'layouts/head-main.php';
include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

$site_id = isset($_GET['id']) ? $_GET['id'] : '';

if (!$site_id) {
    die("Site ID is missing.");
}

// Fetch site details for editing
$query = "SELECT * FROM companies WHERE id = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $site_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Company not found.");
}

$company = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);

    // Update company details
    $update_query = "UPDATE companies SET company_name = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($link, $update_query);
    mysqli_stmt_bind_param($update_stmt, "si", $company_name, $site_id);

    if (mysqli_stmt_execute($update_stmt)) {
        header('Location: companies.php'); // Redirect after successful update
        exit();
    } else {
        $error = "Failed to update company.";
    }
}
?>

<head>
    <title>Edit Company | Minia - Admin & Dashboard Template</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

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
                                <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                                <form method="POST" action="">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="company_name" class="mr-2">Company Name</label>
                                        <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo htmlspecialchars($company['company_name']); ?>" required style="height: calc(2.25rem + 2px);">
                                        <button type="submit" class="btn btn-primary" style="height: calc(2.25rem + 2px); min-width: 150px; margin-left: 10px;">Update Company</button>
                                    </div>
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

<!-- Add JavaScript to alert the user when they click on breadcrumb links -->
<script>
    document.querySelectorAll('.breadcrumb-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            if (!confirm("Are you sure you want to leave this page? Any unsaved changes will be lost.")) {
                event.preventDefault();
            }
        });
    });
</script>

</body>
</html>
