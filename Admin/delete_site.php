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

$id = $_GET['id'] ?? null; // Get the site ID from URL

if (!$id) {
    die("No site ID provided.");
}

// Delete the site
$delete_query = "DELETE FROM sites WHERE id = $id";
if (mysqli_query($link, $delete_query)) {
    header("Location: sites.php"); 
    exit();
} else {
    echo "Error: " . mysqli_error($link);
}
?>

<head>
    <title>Delete Site</title>
    <?php include 'layouts/head.php'; ?>
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
                                <h4 class="card-title">Delete Site</h4>
                            </div>
                            <div class="card-body">
                                <p>Are you sure you want to delete this site?</p>
                                <a href="delete_site.php?id=<?php echo $id; ?>" class="btn btn-danger">Yes, Delete</a>
                                <a href="sites.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'layouts/footer.php'; ?>
    </div>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>
