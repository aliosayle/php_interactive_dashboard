<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['delete_message'])) {
    $alert_type = strpos($_SESSION['delete_message'], 'successfully') !== false ? 'success' : 'danger';
    echo "<div class='alert alert-$alert_type alert-dismissible fade show' role='alert'>
            " . htmlspecialchars($_SESSION['delete_message']) . "
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['delete_message']); // Unset after displaying the message
}
?>

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company_name'])) {
    $company_name = mysqli_real_escape_string($link, $_POST['company_name']);

    $insert_query = "INSERT INTO companies (company_name) VALUES ('$company_name')";
    if (mysqli_query($link, $insert_query)) {
        echo "<script>alert('New company added successfully');</script>";
    } else {
        echo "<script>alert('Error adding company: " . mysqli_error($link) . "');</script>";
    }
}
?>

<head>
    <title>Companies Table | Admin Template</title>
    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Include FontAwesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                        <!-- Breadcrumb above the card -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-3">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Companies</li>
                            </ol>
                        </nav>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Companies Table</h4>
                            </div>

                            <div class="card-body">
                                <!-- Add New Company Form -->
                                <form method="POST" action="add_company.php" class="mb-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i> Add New Company
                                    </button>
                                </form>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Company Name</th>
                                            <th>Actions</th> <!-- New column for buttons -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch data
                                        $query = "SELECT id, company_name FROM companies";
                                        $result = mysqli_query($link, $query);

                                        if (!$result) {
                                            die("Query failed: " . mysqli_error($link));
                                        }

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<tr>";
                                                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                                                echo "<td>";
                                                echo "<a href='edit_company.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a> ";
                                                echo "<a href='delete_company.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete?\")'><i class='fas fa-trash'></i> Delete</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>No data found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'layouts/footer.php'; ?>
    </div>
</div>

    <?php include 'layouts/menu.php'; ?>

        <?php include 'layouts/footer.php'; ?>
    </div>
</div>

<!-- Include JavaScript files -->
<?php include 'layouts/vendor-scripts.php'; ?>
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "searching": true,
            "paging": true,
            "info": true,
            "responsive": true
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
