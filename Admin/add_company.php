<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
// Enable error reporting for debugging
// ini_set('display_errors', 1); // error_reporting(E_ALL);

include 'layouts/config.php';

if (!$link) {
    die("Connection not established: " . mysqli_connect_error());
}

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['site_name'])) {
    $site_name = mysqli_real_escape_string($link, $_POST['site_name']);
    // Insert the site into the database
    $insert_query = "INSERT INTO sites (site_name) VALUES ('$site_name')";

    if (mysqli_query($link, $insert_query)) {
        // Success message
        $success_message = 'New site added successfully.';
        header('Location: sites.php'); // Redirect after successful addition
        exit;
    } else {
        // Error message
        $error_message = 'Error adding site: ' . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Site | Admin Panel</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                                    <li class="breadcrumb-item"><a href="sites.php" class="breadcrumb-link">Sites</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add New Site</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Add New Site</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Display Success or Error Messages -->
                                    <?php if (isset($success_message)): ?>
                                        <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
                                    <?php elseif (isset($error_message)): ?>
                                        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                                    <?php endif; ?>

                                    <!-- Form to add new site -->
                                    <form method="POST" action="">
                                        <div class="form-group mb-3 row">
                                            <div class="col-md-8">
                                                <label for="site_name">Site Name</label>
                                                <input type="text" name="site_name" id="site_name" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary">Add Site</button>
                                            </div>
                                        </div>
                                    </form>
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
