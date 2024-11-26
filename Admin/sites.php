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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['site_name'])) {
    // Add new site to the database
    $site_name = mysqli_real_escape_string($link, $_POST['site_name']);
    $insert_query = "INSERT INTO sites (site_name) VALUES ('$site_name')";
    
    if (mysqli_query($link, $insert_query)) {
        echo "<script>alert('New site added successfully'); window.location.href = 'current_page.php';</script>";
    } else {
        echo "Error: " . mysqli_error($link);
    }
}
?>

<head>
    <title>DataTables | Minia - Admin & Dashboard Template</title>
    <?php include 'layouts/head.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="sites.php">Sites</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Current Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End of Breadcrumb -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sites Table</h4>
                            <!-- Button to open the form -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSiteModal" href="add_site.php">Add Site</button>
                        </div>

                        <!-- Modal for adding new site -->
                        <div class="modal fade" id="addSiteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Site</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="current_page.php">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="site_name">Site Name</label>
                                                <input type="text" class="form-control" id="site_name" name="site_name" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Site</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Site Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Debugging connection state
                                    if (!$link) {
                                        die("Database connection error: " . mysqli_connect_error());
                                    }

                                    // Fetch data
                                    $query = "SELECT id, site_name FROM sites";
                                    $result = mysqli_query($link, $query);

                                    // Check if the query executed successfully
                                    if (!$result) {
                                        die("Query failed: " . mysqli_error($link));
                                    }

                                    // Populate table rows
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['site_name']) . "</td>";
                                            echo "<td>
                                                    <a href='edit_site.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                                    <a href='delete_site.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this site?\")'>Delete</a>
                                                  </td>"; // Edit and Delete buttons
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3'>No data found</td></tr>"; // Updated colspan for 3 columns
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
    // Initialize DataTable with search enabled
    $(document).ready(function() {
        $('#datatable').DataTable({
            "searching": true, // Enable search functionality
            "paging": true,    // Enable pagination
            "info": true,      // Show table info
            "responsive": true // Enable responsive design
        });
    });
</script>

<script src="assets/js/app.js"></script>
</body>
</html>
