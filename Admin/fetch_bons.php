<?php
include 'layouts/config.php';
include 'layouts/session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$user_id = $_SESSION['id'];
$permission_query = "SELECT canedit FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

$draw = isset($_POST['draw']) ? $_POST['draw'] : 0;
$start = isset($_POST['start']) ? $_POST['start'] : 0;
$length = isset($_POST['length']) ? $_POST['length'] : 10; // Default to 10 records per page
$searchValue = isset($_POST['searchValue']) ? $_POST['searchValue'] : ''; // Fetch the search term

// Base query to fetch data
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

// Default sorting by created_at (latest first)
$defaultOrderBy = "bon.created_at DESC";

// Check if sorting is requested by DataTables
$orderColumn = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : null;
$orderDir = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : null;

// Map the column index to the actual column name (adjust if needed)
$columns = [
    'created_at', 
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

// Apply sorting based on request or default to created_at DESC
if ($orderColumn !== null && isset($columns[$orderColumn])) {
    $orderBy = $columns[$orderColumn] . " " . ($orderDir === 'asc' ? 'DESC' : 'ASC');
} else {
    $orderBy = $defaultOrderBy; // Default sorting by created_at DESC
}

// Add ORDER BY clause to the base query
$baseQuery .= " ORDER BY $orderBy";

// If length is -1 (All), remove the LIMIT clause
if ($length == -1) {
    // No LIMIT clause needed
} else {
    $baseQuery .= " LIMIT $start, $length";  // Apply pagination
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

            <button type='button' class='btn btn-sm btn-secondary print-btn' data-bon-id='" . htmlspecialchars($row['id']) . "'>
                <i class='fas fa-print'></i>
            </button>
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