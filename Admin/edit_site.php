<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include('layouts/config.php'); ?>

<?php
// Configuration and session handling
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_SESSION['id'];
$permission_query = "SELECT canedit FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);
if($permissions['canedit'] != 1) {
    header('Location: index.php');
    exit();
}

// Retrieve site details and handle form submission
$site_id = $_POST['site_id'] ?? null;
if (!$site_id) {
    header("Location: sites.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_submitted'])) {
    $name = $_POST['name'];

    $update_sql = "UPDATE sites SET name = ? WHERE id = ?";
    if ($stmt = $link->prepare($update_sql)) {
        $stmt->bind_param("ss", $name, $site_id);
        $stmt->execute();
        $stmt->close();
    }
    $link->close();
    header("Location: sites.php");
    exit;
}

// Fetch existing site details
$site = null;
$fetch_sql = "SELECT * FROM sites WHERE id = ?";
if ($stmt = $link->prepare($fetch_sql)) {
    $stmt->bind_param("s", $site_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $site = $result->fetch_assoc();
    $stmt->close();
}

if (!$site) {
    header("Location: sites.php");
    echo $site_id, $site_name;
    exit;
}
?>

<head>
    <title>Edit Site | Admin Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">
    <?php include 'layouts/menu.php'; ?>

    <div class="main-content">
        <div class="page-content">
            <div class="site-fluid">

                <!-- Start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Login</li>
                                <li class="breadcrumb-item"><a href="sites.php">Sites</a></li>
                                <li class="breadcrumb-item active">Edit Site</li>
                            </ol>
                        </div>
                        <br>
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Edit Site</h4>
                        </div>
                    </div>
                </div>
                <!-- End page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Site Details</h4>
                                <p class="card-title-desc">Update the following details to edit the site.</p>
                            </div>
                            <div class="card-body p-4">
                            <form method="POST">
    <input type="hidden" name="form_submitted" value="1">
    <input type="hidden" name="site_id" value="<?php echo htmlspecialchars($site_id); ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="<?php echo htmlspecialchars($site['name']); ?>" required>
            </div>
        </div>
    </div>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- site-fluid -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- End main content-->
</div>
<!-- END layout-wrapper -->

<?php include 'layouts/right-sidebar.php'; ?>
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
