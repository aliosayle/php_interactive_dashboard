<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Edit Bon | Admin Dashboard</title>
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
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Edit Bon</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="bons.php">Bons</a></li>
                                    <li class="breadcrumb-item active">Edit Bon</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Transaction Details</h4>
                                <p class="card-title-desc">Edit the details of the bon record below.</p>
                            </div>
                            <div class="card-body p-4">

                                <?php
                                error_reporting(E_ALL);
                                ini_set('display_errors', 1);
                                // Fetch the existing data from the database
                                // include 'layouts/config.php';
                                if (isset($_GET['bon_id'])) {
                                    $id = $_GET['bon_id'];
                                    $query = "SELECT * FROM bon WHERE id = '$id'";
                                    $result = mysqli_query($link, $query);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                    } else {
                                        echo "<p>Bon not found.</p>";
                                        exit;
                                    }
                                }
                                // echo "<pre>";
                                // print_r($row);
                                // echo "</pre>";
                                ?>

                                <form action="process_edit_bon.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="reference" class="form-label">Reference</label>
                                                <input class="form-control" type="text" name="reference" id="reference"
                                                    value="<?php echo htmlspecialchars($row['reference']); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sequence_reference" class="form-label">Sequence Reference</label>
                                                <input class="form-control" type="text" name="sequence_reference"
                                                    id="sequence_reference" value="<?php echo htmlspecialchars($row['sequence_reference']); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">User ID</label>
                                                <input class="form-control" type="text" name="user_id" id="user_id"
                                                    value="<?php echo htmlspecialchars($row['user_id']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="company_name" class="form-label">Company Name</label>
                                                <select class="form-select" id="company_name" name="company_name" required>
                                                    <option value="" disabled>Select a company</option>
                                                    <?php
                                                    $query = "SELECT id, company_name FROM companies";
                                                    $result = mysqli_query($link, $query);
                                                    while ($company = mysqli_fetch_assoc($result)) {
                                                        $selected = ($company['id'] == $row['company_id']) ? 'selected' : '';
                                                        echo "<option value='{$company['id']}' $selected>{$company['company_name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="total_one" class="form-label">Amount 1</label>
                                                <input class="form-control" type="number" step="0.01" name="total_one"
                                                    id="total_one" value="<?php echo $row['total_one']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="currency_one" class="form-label">Currency 1</label>
                                                <select class="form-select" name="currency_one" id="currency_one">
                                                    <option value="USD" <?php echo ($row['currency_one'] == 'USD') ? 'selected' : ''; ?>>USD</option>
                                                    <option value="EUR" <?php echo ($row['currency_one'] == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                                                    <option value="CF" <?php echo ($row['currency_one'] == 'CF') ? 'selected' : ''; ?>>CF</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="amount_2" class="form-label">Amount 2</label>
                                                <input class="form-control" type="number" step="0.01" name="amount_2"
                                                    id="amount_2" value="<?php echo $row['total_two']; ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="currency_two" class="form-label">Currency 2</label>
                                                <select class="form-select" name="currency_2" id="currency_2">
                                                    <option value="USD" <?php echo ($row['currency_two'] == 'USD') ? 'selected' : ''; ?>>USD</option>
                                                    <option value="EUR" <?php echo ($row['currency_two'] == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                                                    <option value="CF" <?php echo ($row['currency_two'] == 'CF') ? 'selected' : ''; ?>>CF</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="is_voided" class="form-label">Is Voided</label>
                                                <select class="form-select" name="is_voided" id="is_voided" required>
                                                    <option value="1" <?php echo ($row['is_voided'] == '1') ? 'selected' : ''; ?>>Yes</option>
                                                    <option value="0" <?php echo ($row['is_voided'] == '0') ? 'selected' : ''; ?>>No</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="date_of_bon" class="form-label">Transaction Date</label>
                                                <input class="form-control" type="date" name="date_of_bon" id="date_of_bon"
                                                    value="<?php echo $row['date_of_bon']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">User Name</label>
                                                <input class="form-control" type="text" name="username" id="username"
                                                    value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="site_name" class="form-label">Site</label>
                                                <select class="form-select select2" name="site_name" id="site_name" required>
                                                    <option value="">Select a site</option>
                                                    <?php
                                                    $query = "SELECT site_name FROM sites";
                                                    $result = mysqli_query($link, $query);
                                                    while ($site = mysqli_fetch_assoc($result)) {
                                                        $selected = ($site['site_name'] == $row['site_name']) ? 'selected' : '';
                                                        echo '<option value="' . htmlspecialchars($site['site_name'], ENT_QUOTES) . '" ' . $selected . '>' . htmlspecialchars($site['site_name'], ENT_QUOTES) . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Comments</label>
                                                <textarea class="form-control" name="description" id="comments"
                                                    rows="3"><?php echo htmlspecialchars($row['comments']); ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Account Number</label>
                                                <input class="form-control" type="text" name="account_number"
                                                    id="account_number" value="<?php echo htmlspecialchars($row['account_number']); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="motif" class="form-label">Motive</label>
                                                <input class="form-control" type="text" name="motif" id="motif"
                                                    value="<?php echo htmlspecialchars($row['motif']); ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="beneficier_name" class="form-label">Beneficier Name</label>
                                                <input class="form-control" type="text" name="beneficier_name" id="beneficier_name"
                                                    value="<?php echo htmlspecialchars($row['beneficier_name']); ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update Bon</button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div>
                </div> <!-- end row -->

            </div><!-- container-fluid -->
        </div><!-- page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- End main content -->
</div>
<!-- END layout-wrapper -->

<?php include 'layouts/right-sidebar.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>

</body>
</html>
