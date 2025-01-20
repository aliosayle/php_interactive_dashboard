<?php
include 'layouts/config.php';
include 'layouts/session.php';

$user_id = $_SESSION['id'];
$permission_query = "SELECT canedit FROM users WHERE id = '$user_id'";
$permission_result = mysqli_query($link, $permission_query);
$permissions = mysqli_fetch_assoc($permission_result);

// Retrieve request parameters
$draw = intval($_POST['draw']);
$start = intval($_POST['start']);
$length = intval($_POST['length']);
$searchValue = $_POST['search']['value'];

// Query to fetch data
$baseQuery = "SELECT bon.*, 
                sites.name AS site_name, 
                companies.name AS company_name 
              FROM bon 
              LEFT JOIN sites ON bon.site_id = sites.id 
              LEFT JOIN companies ON bon.company_id = companies.id";

// Add search functionality
if (!empty($searchValue)) {
    $baseQuery .= " WHERE 
        bon.reference LIKE '%" . mysqli_real_escape_string($link, $searchValue) . "%' OR 
        bon.beneficier_name LIKE '%" . mysqli_real_escape_string($link, $searchValue) . "%'";
}

// Count total records (without limit)
$totalRecordsResult = mysqli_query($link, str_replace('SELECT bon.*', 'SELECT COUNT(*) as count', $baseQuery));
$totalRecords = mysqli_fetch_assoc($totalRecordsResult)['count'];

// Add pagination and sorting
$baseQuery .= " LIMIT $start, $length";

// Fetch data
$dataResult = mysqli_query($link, $baseQuery);
$data = [];
while ($row = mysqli_fetch_assoc($dataResult)) {
    $data[] = [
        'reference' => htmlspecialchars($row['reference']),
        'beneficier_name' => htmlspecialchars($row['beneficier_name']),
        'date_of_bon' => htmlspecialchars($row['date_of_bon']),
        'total_one' => htmlspecialchars($row['total_one']),
        'total_two' => htmlspecialchars($row['total_two']),
        'currency_one' => htmlspecialchars($row['currency_one']),
        'currency_two' => htmlspecialchars($row['currency_two']),
        'amount_in_lettres' => htmlspecialchars($row['amount_in_lettres']),
        'site_name' => htmlspecialchars($row['site_name']),
        'company_name' => htmlspecialchars($row['company_name']),
        'motif' => htmlspecialchars($row['motif']),
        'account_number' => htmlspecialchars($row['account_number']),
        'is_voided' => $row['is_voided'] == 1 ? 'Yes' : 'No',
        'comments' => htmlspecialchars($row['comments']),
'actions' => "
    <form method='GET' action='edit_bon.php' style='display:inline-block;'>
        <input type='hidden' name='bon_id' value='" . htmlspecialchars($row['id']) . "'>
        <button type='submit' class='btn btn-sm btn-info' " . ($permissions['canedit'] == 0 ? 'disabled' : '') . ">
            <i class='fas fa-pencil-alt'></i>
        </button>
    </form>

    <!-- Delete Button with FontAwesome icon -->
    <form method='GET' action='delete_bon.php' style='display:inline-block;' class='delete-form'>
        <input type='hidden' name='bon_id' value='" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "'>
        <button type='button' class='btn btn-sm btn-danger delete-btn' onclick='confirmDelete(this)'>
            <i class='fas fa-trash-alt'></i>
        </button>
    </form>

    <!-- Print Button with FontAwesome icon -->
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
    "recordsFiltered" => $totalRecords,
    "data" => $data
];

echo json_encode($response);
?>
