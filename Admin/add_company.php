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
        // Success alert
        $alert_message = "New company added successfully.";
        $alert_type = "success";
    } else {
        // Error alert
        $alert_message = "Error adding company: " . mysqli_error($link);
        $alert_type = "danger";
    }
}
?>

<head>
    <title>Add Company | Minia - Admin & Dashboard Template</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

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

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Displaying Modal based on the form submission result -->
<?php if (isset($alert_message)): ?>
    <script>
        $(document).ready(function() {
            $('#alertModal').modal('show');
            
            // When the "OK" button is clicked, dismiss the modal and redirect
            $('#modalOkButton').click(function() {
                $('#alertModal').modal('hide'); // Hide the modal
                window.location.href = 'companies.php'; // Redirect after the modal is closed
            });

            // Optionally, you can keep the redirect logic when clicking anywhere outside the modal
            $('#alertModal').on('hidden.bs.modal', function () {
                window.location.href = 'companies.php'; // Redirect after the modal is closed
            });
        });
    </script>
<?php endif; ?>

<!-- Bootstrap Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-<?php echo $alert_type; ?>">
        <h5 class="modal-title" id="alertModalLabel"><?php echo ucfirst($alert_type); ?> Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo $alert_message; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-<?php echo $alert_type; ?>" id="modalOkButton">OK</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
