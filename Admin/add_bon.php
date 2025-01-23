<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>
    <title><?= ($_SESSION['lang'] == 'fr' ? 'Ajouter Bon' : 'Add Bon') ?> | Admin Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Include jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><?= ($_SESSION['lang'] == 'fr' ? 'Connexion' : 'Login') ?>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="bons.php"><?= ($_SESSION['lang'] == 'fr' ? 'Bons' : 'Bons') ?></a></li>
                                <li class="breadcrumb-item active">
                                    <?= ($_SESSION['lang'] == 'fr' ? 'Ajouter un nouveau Bon' : 'Add New Bon') ?>
                                </li>
                            </ol>
                        </div>
                        <br>
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">
                                <?= ($_SESSION['lang'] == 'fr' ? 'Ajouter un nouveau Bon' : 'Add New Bon') ?>
                            </h4>
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
                                    <?= ($_SESSION['lang'] == 'fr' ? 'Veuillez remplir les informations suivantes pour créer un nouveau bon.' : 'Please fill in the following details to create a new bon record.') ?>
                                </p>
                            </div>
                            <div class="card-body p-4">
                                <form action="process_add_bon.php" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">


                                            <div class="mb-3">
                                                <label for="sequence_reference" class="form-label">
                                                    <?= ($_SESSION['lang'] == 'fr' ? 'Référence de commande' : 'Order Reference') ?>
                                                </label>

                                                <input class="form-control" type="text" name="sequence_reference"
                                                    id="sequence_reference">
                                            </div>



                                            <div class="mb-3">
                                                <label for="company_id"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Nom de l\'entreprise' : 'Company Name') ?></label>
                                                <select class="form-select" id="company_id" name="company_id" required>
                                                    <option value="" disabled selected>
                                                        <?= ($_SESSION['lang'] == 'fr' ? 'Sélectionner une entreprise' : 'Select a company') ?>
                                                    </option>
                                                    <?php
                                                    include 'layouts/config.php';
                                                    $query = "SELECT id, name FROM companies";
                                                    $result = mysqli_query($link, $query);
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="amount_1"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Montant 1' : 'Amount 1') ?></label>
                                                <input class="form-control" type="number" step="0.01" name="amount_1"
                                                    id="amount_1" value="0.0" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="currency_1"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Devise 1' : 'Currency 1') ?></label>
                                                <select class="form-select" name="currency_1" id="currency_1">
                                                    <option value="USD" <?php echo ($currency_1 == 'USD') ? 'selected' : ''; ?>>USD</option>
                                                    <option value="EUR" <?php echo ($currency_1 == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                                                    <option value="CF" <?php echo ($currency_1 == 'CF') ? 'selected' : ''; ?>>CF</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="amount_2" class="form-label">
                                                    <?= ($_SESSION['lang'] == 'fr' ? 'Montant 2' : 'Amount 2') ?>
                                                </label>
                                                <input class="form-control" type="number" step="0.01" name="amount_2"
                                                    id="amount_2" value="0.0">
                                            </div>


                                            <div class="mb-3">
                                                <label for="currency_2"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Devise 2' : 'Currency 2') ?></label>
                                                <select class="form-select" name="currency_2" id="currency_2">
                                                    <option value="CF" <?php echo ($currency_2 == 'CF') ? 'selected' : ''; ?>>CF</option>
                                                    <option value="EUR" <?php echo ($currency_2 == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="isvoided"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Est annulé' : 'Is Voided') ?></label>
                                                <select class="form-select" name="isvoided" id="isvoided" required>
                                                    <option value="1"><?= ($_SESSION['lang'] == 'fr' ? 'Oui' : 'Yes') ?>
                                                    </option>
                                                    <option value="0" selected>
                                                        <?= ($_SESSION['lang'] == 'fr' ? 'Non' : 'No') ?>
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="date" class="form-label">
                                                    <?= ($_SESSION['lang'] == 'fr' ? 'Date de la transaction' : 'Transaction Date') ?>
                                                </label>
                                                <input class="form-control" type="date" name="date" id="date" required
                                                    value="<?= date('Y-m-d') ?>">
                                            </div>

                                        </div>

                                        <div class="col-lg-6">


                                            <div class="mb-3">
                                                <label for="site_id"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Nom du site' : 'Site Name') ?></label>
                                                <select class="form-select" id="site_id" name="site_id" required>
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
                                                <label for="description"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Commentaires' : 'Comments') ?></label>
                                                <textarea class="form-control" name="description" id="description"
                                                    rows="3"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="account_number"
                                                    class="form-label"><?= ($_SESSION['lang'] == 'fr' ? 'Numéro de compte' : 'Account Number') ?></label>
                                                <input class="form-control" type="text" name="account_number"
                                                    id="account_number">
                                            </div>

                                            <div class="mb-3">
                                                <label for="motive" class="form-label">
                                                    <?= ($_SESSION['lang'] == 'fr' ? 'Motif' : 'Motive') ?>
                                                </label>
                                                <input class="form-control" type="text" name="motive" id="motive"
                                                    maxlength="100" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="beneficier_name" class="form-label">
                                                    <?= ($_SESSION['lang'] == 'fr' ? 'Nom du bénéficiaire' : 'Beneficiary Name') ?>
                                                </label>
                                                <input class="form-control" type="text" name="beneficier_name"
                                                    id="beneficier_name" required>
                                            </div>


                                            <div class="mb-3">
                                                <button type="submit"
                                                    class="btn btn-primary"><?= ($_SESSION['lang'] == 'fr' ? 'Ajouter Bon' : 'Add Bon') ?></button>
                                            </div>
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

    <!-- End Right content -->
</div>

<?php include 'layouts/footer.php'; ?>

<script>
    $(document).ready(function () {
        $('#company_id').select2();
        $('#site_id').select2();
    });
</script>

<?php include 'layouts/body-close.php'; ?>