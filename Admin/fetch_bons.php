<?php
include 'layouts/config.php';
include 'layouts/session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_SESSION['id'];
$permission_query = "SELECT canedit FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

// Check if the user has 'canedit' set to 0
if ($permissions['canedit'] == 0) {
    header("Location: index.php"); // Redirect to index.php
    exit(); // Make sure no further code is executed
}


$draw = isset($_POST['draw']) ? $_POST['draw'] : 0;
$start = isset($_POST['start']) ? $_POST['start'] : 0;
$length = isset($_POST['length']) ? $_POST['length'] : 10; // Default to 10 records per page
// Get search term from DataTables request
$searchValue = isset($_POST['searchValue']) ? $_POST['searchValue'] : ''; // Fetch the search term

// Query to fetch data
$baseQuery = "SELECT bon.*, 
                sites.name AS site_name, 
                companies.name AS company_name 
              FROM bon 
              LEFT JOIN sites ON bon.site_id = sites.id 
              LEFT JOIN companies ON bon.company_id = companies.id";

// Add search functionality if there is a search term
if (!empty($searchValue)) {
    $baseQuery .= " WHERE 
        bon.reference LIKE '%" . mysqli_real_escape_string($link, $searchValue) . "%' OR 
        bon.beneficier_name LIKE '%" . mysqli_real_escape_string($link, $searchValue) . "%' OR
        sites.name LIKE '%" . mysqli_real_escape_string($link, $searchValue) . "%' OR 
        companies.name LIKE '%" . mysqli_real_escape_string($link, $searchValue) . "%' OR
        bon.account_number LIKE '%" . mysqli_real_escape_string($link, $searchValue) . "%'"; // Added account_number search
}



// Count total records (without limit)
$totalRecordsResult = mysqli_query($link, str_replace('SELECT bon.*', 'SELECT COUNT(*) as count', $baseQuery));
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['count'];

// Add pagination and sorting
$length = isset($_POST['length']) ? $_POST['length'] : 10; // Default to 10 records per page

// Get the column index and order direction from the DataTables request
$orderColumn = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 0;  // Default to first column
$orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc';  // Default to ascending

// Map the column index to the actual column name (adjust if needed)
$columns = [
    'reference', 
    'beneficier_name', 
    'date_of_bon', 
    'total_one', 
    'total_two', 
    'currency_one', 
    'currency_two', 
    'site_name', 
    'company_name', 
    'motif', 
    'account_number', 
    'is_voided', 
    'comments'
];
$orderBy = $columns[$orderColumn];

// If length is -1 (All), remove the LIMIT clause
if ($length == -1) {
    $baseQuery .= " ORDER BY $orderBy $orderDir";  // Apply sorting without pagination
} else {
    $baseQuery .= " ORDER BY $orderBy $orderDir LIMIT $start, $length";  // Apply sorting with pagination
}


// Fetch data
$dataResult = mysqli_query($link, $baseQuery);
$data = [];
while ($row = mysqli_fetch_assoc($dataResult)) {
    $data[] = [
        'reference' => isset($row['reference']) ? htmlspecialchars($row['reference']) : '',
        'beneficier_name' => isset($row['beneficier_name']) ? htmlspecialchars($row['beneficier_name']) : '',
        'date_of_bon' => isset($row['date_of_bon']) ? htmlspecialchars($row['date_of_bon']) : '',
        'total_one' => isset($row['total_one']) ? htmlspecialchars($row['total_one']) : '',
        'total_two' => isset($row['total_two']) ? htmlspecialchars($row['total_two']) : '',
        'currency_one' => isset($row['currency_one']) ? htmlspecialchars($row['currency_one']) : '',
        'currency_two' => isset($row['currency_two']) ? htmlspecialchars($row['currency_two']) : '',
        'amount_in_lettres' => isset($row['amount_in_lettres']) ? htmlspecialchars($row['amount_in_lettres']) : '',
        'site_name' => isset($row['site_name']) ? htmlspecialchars($row['site_name']) : '',
        'company_name' => isset($row['company_name']) ? htmlspecialchars($row['company_name']) : '',
        'motif' => isset($row['motif']) ? htmlspecialchars($row['motif']) : '',
        'account_number' => isset($row['account_number']) ? htmlspecialchars($row['account_number']) : '',
        'is_voided' => $row['is_voided'] == 1 ? 'Yes' : 'No',
        'comments' => isset($row['comments']) ? htmlspecialchars($row['comments']) : '',
        'actions' => "
            <form method='GET' action='edit_bon.php' style='display:inline-block;'>
                <input type='hidden' name='bon_id' value='" . htmlspecialchars($row['id']) . "'>
                <button type='submit' class='btn btn-sm btn-info' " . ($permissions['canedit'] == 0 ? 'disabled' : '') . ">
                    <i class='fas fa-pencil-alt'></i>
                </button>
            </form>

            <form method='GET' action='delete_bon.php' style='display:inline-block;' class='delete-form'>
                <input type='hidden' name='bon_id' value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>
                <button type='button' class='btn btn-sm btn-danger delete-btn' onclick='confirmDelete(this)'>
                    <i class='fas fa-trash-alt'></i>
                </button>
            </form>

            <form method='POST' action='design.php' style='display:inline-block;'>
                <input type='hidden' name='bon_id' value='" . htmlspecialchars($row['id']) . "'>
                <button type='submit' class='btn btn-sm btn-secondary'>
                    <i class='fas fa-print'></i>
                </button>
            </form>
        "
    ];
}

// Return data as JSON
$response = [
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords, // This should be updated if you're applying filtering
    "data" => $data
];

echo json_encode($response);

?>
