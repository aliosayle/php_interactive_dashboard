<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title>Add Bon | Admin Dashboard</title>
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
                            <h4 class="mb-sm-0 font-size-18">Add New Bon</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Add New Bon</li>
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
                                <p class="card-title-desc">Please fill in the following details to create a new bon
                                    record.</p>
                            </div>
                            <div class="card-body p-4">

                                <form action="process_add_bon.php" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="reference" class="form-label">Reference</label>
                                                <input class="form-control" type="text" name="reference" id="reference"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="sequence_reference" class="form-label">Sequence
                                                    Reference</label>
                                                <input class="form-control" type="text" name="sequence_reference"
                                                    id="sequence_reference" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">User ID</label>
                                                <input class="form-control" type="text" name="user_id" id="user_id"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="company_name" class="form-label">Company Name</label>
                                                <select class="form-select" id="company_name" name="company_name" required>
                                                    <option value="" disabled selected>Select a company</option>
                                                    <?php
                                                    include 'layouts/config.php';
                                                    $query = "SELECT id, company_name FROM companies";
                                                    $result = mysqli_query($link, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='{$row['id']}'>{$row['company_name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- Hidden Field for Company ID -->
                                            <input type="hidden" id="company_id" name="company_id" required>



                                            <div class="mb-3">
                                                <label for="amount_1" class="form-label">Amount 1</label>
                                                <input class="form-control" type="number" step="0.01" name="amoun_1"
                                                    id="amount_1" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="currency_1" class="form-label">Currency 1</label>
                                                <select class="form-select" name="currency_1" id="currency_1">
                                                    <option value="USD">USD</option>
                                                    <option value="EUR">EUR</option>
                                                    <option value="CF">CF</option>
                                                    <!-- Add other currencies as needed -->
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="amount_2" class="form-label">Amount 2</label>
                                                <input class="form-control" type="number" step="0.01" name="amount_2"
                                                    id="amount_2">
                                            </div>



                                            <div class="mb-3">
                                                <label for="currency_2" class="form-label">Currency 2</label>
                                                <select class="form-select" name="currency_2" id="currency_2">
                                                    <option value="USD">USD</option>
                                                    <option value="EUR">EUR</option>
                                                    <option value="CF">CF</option>
                                                    <!-- Add other currencies as needed -->
                                                </select>
                                            </div>



                                            <div class="mb-3">
                                                <label for="isvoided" class="form-label">Is Voided</label>
                                                <select class="form-select" name="isvoided" id="isvoided" required>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="date" class="form-label">Transaction Date</label>
                                                <input class="form-control" type="date" name="date" id="date" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="user_name" class="form-label">User Name</label>
                                                <input class="form-control" type="text" name="user_name" id="user_name"
                                                    required>
                                            </div>


                                            <div class="mb-3">
                                                <label for="site_name" class="form-label">Site</label>
                                                <select class="form-select select2" name="site_name" id="site_name" required>
                                                    <option value="">Select a site</option>
                                                    <?php
                                                    $query = "SELECT site_name FROM sites";
                                                    $result = mysqli_query($link, $query);

                                                    if ($result) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . htmlspecialchars($row['site_name'], ENT_QUOTES) . '">' . htmlspecialchars($row['site_name'], ENT_QUOTES) . '</option>';
                                                        }
                                                    } else {
                                                        echo '<option value="">Error fetching sites</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="description" class="form-label">Comments</label>
                                                <textarea class="form-control" name="description" id="description"
                                                    rows="3"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Account Number</label>
                                                <input class="form-control" type="text" name="account_number"
                                                    id="account_number" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="motive" class="form-label">Motive</label>
                                                <input class="form-control" type="text" name="motive" id="motive"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="paid_by" class="form-label">Beneficier Name</label>
                                                <input class="form-control" type="text" name="beneficier_name" id="beneficier_name"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->
<?php include 'layouts/vendor-scripts.php'; ?>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select a site",
            allowClear: true
        });
    });
</script>

<script src="assets/js/app.js"></script>

</body>

</html>