<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php include 'layouts/config.php'?>
<?php 
//enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<head>
    <title>Edit Bon | Admin Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>



</head>

<?php include 'layouts/body.php';
$lang = isset($_SESSION['lang']) && in_array($_SESSION['lang'], ['en', 'fr']) ? $_SESSION['lang'] : 'en';
?>

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


                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-3">
                                    <li class="breadcrumb-item"><a href="bons.php">Bons</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Edit Bon
                                    </li>
                                </ol>

                            </nav>
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Edit Bon</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
    <h4 class="card-title">
        <?= ($_SESSION['lang'] == 'fr' ? 'Détails de la transaction' : 'Transaction Details') ?>
    </h4>
    <p class="card-title-desc">
        <?= ($_SESSION['lang'] == 'fr' ? 'Modifiez les détails de l\'enregistrement du bon ci-dessous.' : 'Edit the details of the bon record below.') ?>
    </p>
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
            <label for="sequence_reference" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Référence de séquence' : 'Sequence Reference') ?>
            </label>
            <input class="form-control" type="text" name="sequence_reference"
                id="sequence_reference" value="<?php echo htmlspecialchars($row['sequence_reference']); ?>" required>
        </div>



        <div class="mb-3">
            <label for="company_name" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Nom de l\'entreprise' : 'Company Name') ?>
            </label>
            <select class="form-select" id="company_name" name="company_name" required>
                <option value="" disabled>
                    <?= ($_SESSION['lang'] == 'fr' ? 'Sélectionner une entreprise' : 'Select a company') ?>
                </option>
                <?php
                $query = "SELECT id, name FROM companies";
                $result = mysqli_query($link, $query);
                while ($company = mysqli_fetch_assoc($result)) {
                    $selected = ($company['id'] == $row['company_id']) ? 'selected' : '';
                    echo "<option value='{$company['id']}' $selected>{$company['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="total_one" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Montant 1' : 'Amount 1') ?>
            </label>
            <input class="form-control" type="number" step="0.01" name="total_one"
                id="total_one" value="<?php echo $row['total_one']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="currency_one" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Devise 1' : 'Currency 1') ?>
            </label>
            <select class="form-select" name="currency_one" id="currency_one">
                <option value="USD" <?php echo ($row['currency_one'] == 'USD') ? 'selected' : ''; ?>>USD</option>
                <option value="EUR" <?php echo ($row['currency_one'] == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                <option value="CF" <?php echo ($row['currency_one'] == 'CF') ? 'selected' : ''; ?>>CF</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="amount_2" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Montant 2' : 'Amount 2') ?>
            </label>
            <input class="form-control" type="number" step="0.01" name="amount_2"
                id="amount_2" value="<?php echo $row['total_two']; ?>">
        </div>

        <div class="mb-3">
            <label for="currency_two" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Devise 2' : 'Currency 2') ?>
            </label>
            <select class="form-select" name="currency_2" id="currency_2">
                <option value="USD" <?php echo ($row['currency_two'] == 'USD') ? 'selected' : ''; ?>>USD</option>
                <option value="EUR" <?php echo ($row['currency_two'] == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                <option value="CF" <?php echo ($row['currency_two'] == 'CF') ? 'selected' : ''; ?>>CF</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="is_voided" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Est annulé' : 'Is Voided') ?>
            </label>
            <select class="form-select" name="is_voided" id="is_voided" required>
                <option value="1" <?php echo ($row['is_voided'] == '1') ? 'selected' : ''; ?>>
                    <?= ($_SESSION['lang'] == 'fr' ? 'Oui' : 'Yes') ?>
                </option>
                <option value="0" <?php echo ($row['is_voided'] == '0') ? 'selected' : ''; ?>>
                    <?= ($_SESSION['lang'] == 'fr' ? 'Non' : 'No') ?>
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_of_bon" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Date de la transaction' : 'Transaction Date') ?>
            </label>
            <input class="form-control" type="date" name="date_of_bon" id="date_of_bon"
                value="<?php echo $row['date_of_bon']; ?>" required>
        </div>
    </div>

    <div class="col-lg-6">


        <div class="mb-3">
            <label for="site_name" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Nom du site' : 'Site Name') ?>
            </label>
            <select class="form-select" id="site_name" name="site_name" required>
                <option value="" disabled>
                    <?= ($_SESSION['lang'] == 'fr' ? 'Sélectionner un site' : 'Select a site') ?>
                </option>
                <?php
                $query = "SELECT id, name FROM sites";
                $result = mysqli_query($link, $query);
                while ($site = mysqli_fetch_assoc($result)) {
                    $selected = ($site['id'] == $row['site_id']) ? 'selected' : '';
                    echo "<option value='{$site['id']}' $selected>{$site['name']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Commentaires' : 'Comments') ?>
            </label>
            <textarea class="form-control" name="description" id="comments"
                rows="3"><?php echo htmlspecialchars($row['comments']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="account_number" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Numéro de compte' : 'Account Number') ?>
            </label>
            <input class="form-control" type="text" name="account_number"
                id="account_number" value="<?php echo htmlspecialchars($row['account_number']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="motif" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Motif' : 'Motive') ?>
            </label>
            <input class="form-control" type="text" name="motif" id="motif"
                value="<?php echo htmlspecialchars($row['motif']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="beneficier_name" class="form-label">
                <?= ($_SESSION['lang'] == 'fr' ? 'Nom du bénéficiaire' : 'Beneficier Name') ?>
            </label>
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

<script>

jQuery.noConflict();
jQuery(document).ready(function($) {
  // Initialize both select lists with Select2
  $('#company_name').select2();
  $('#site_name').select2();
});


</script>


<?php include 'layouts/right-sidebar.php'; ?>
<?php include 'layouts/vendor-scripts.php'; ?>

</body>
</html>
