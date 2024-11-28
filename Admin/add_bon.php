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

                                <form action="add_bon.php" method="POST">
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
                                                <label for="company_id" class="form-label">Company ID</label>
                                                <input class="form-control" type="text" name="company_id"
                                                    id="company_id" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="amount_1" class="form-label">Amount 1</label>
                                                <input class="form-control" type="number" step="0.01" name="amoun_1"
                                                    id="amount_1" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="currency_1" class="form-label">Currency 1</label>
                                                <select class="form-select" name="currency_1" id="currency_1" required>
                                                    <option value="USD">USD</option>
                                                    <option value="EUR">EUR</option>
                                                    <option value="EGP">CF</option>
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
                                                    <option value="EGP">CF</option>
                                                    <!-- Add other currencies as needed -->
                                                </select>
                                            </div>



                                            <div class="mb-3">
                                                <label for="is_voided" class="form-label">Is Voided</label>
                                                <select class="form-select" name="isvoided" id="isvoided" required>
                                                    <option value="USD">Yes</option>
                                                    <option value="EUR">No</option>
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
                                                <label for="site_id" class="form-label">Site ID</label>
                                                <input class="form-control" type="text" name="site_id" id="site_id"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="company_name" class="form-label">Company Name</label>
                                                <input class="form-control" type="text" name="company_name"
                                                    id="company_name" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Comments</label>
                                                <textarea class="form-control" name="description" id="description"
                                                    rows="3" required></textarea>
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
                                                <input class="form-control" type="text" name="paid_by" id="paid_by"
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

<script src="assets/js/app.js"></script>

</body>

</html>