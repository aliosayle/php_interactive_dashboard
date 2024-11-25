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
$query = "SELECT * FROM sites WHERE id = ?";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "i", $site_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Site not found.");
}

$site = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $site_name = mysqli_real_escape_string($link, $_POST['site_name']);

    // Update site details
    $update_query = "UPDATE sites SET site_name = ? WHERE id = ?";
    $update_stmt = mysqli_prepare($link, $update_query);
    mysqli_stmt_bind_param($update_stmt, "si", $site_name, $site_id);

    if (mysqli_stmt_execute($update_stmt)) {
        header('Location: sites.php'); // Redirect after successful update
        exit();
    } else {
        $error = "Failed to update site.";
    }
}
?>

<head>
    <title>Edit Site | Minia - Admin & Dashboard Template</title>
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
                                <h4 class="card-title">Edit Site</h4>
                            </div>
                            <div class="card-body">
                                <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="site_name">Site Name</label>
                                        <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo htmlspecialchars($site['site_name']); ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Site</button>
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
