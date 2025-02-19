<?php
ini_set('display_errors', 1);  // Enable the display of errors
error_reporting(E_ALL);        // Report all types of errors, including notices

include '../layouts/session.php';
// include '../layouts/head-main.php';
include '../layouts/config.php';

if (!$link) {
    die("Connection not established: " . link_connect_error());
}


// Fetch dropdown data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search = $_GET['search'] ?? '';
    $page = $_GET['page'] ?? 1;
    $tableGuid = $_GET['table_guid'] ?? '';
    $keyfieldGuid = $_GET['keyfield_guid'] ?? '';
    $listfieldGuid = $_GET['listfield_guid'] ?? '';
    $fixedListGuid = $_GET['fixed_list_guid'] ?? '';
    $allowClearGuid = $_GET['allow_clear_guid'] ?? '';
    $limit = 10;
    $offset = ($page - 1) * $limit;

    // Log the request parameters
    error_log("Request Parameters: search=$search, page=$page, table_guid=$tableGuid, keyfield_guid=$keyfieldGuid, listfield_guid=$listfieldGuid, fixed_list_guid=$fixedListGuid, allow_clear_guid=$allowClearGuid");

    // Validate GUIDs for table, fields, and parameters
    function resolveDescr($link, $guid, $type) {
        $query = $link->prepare("SELECT descr FROM lookup_references WHERE id = ? AND type = ?");
        $query->bind_param('ss', $guid, $type);
        $query->execute();
        $result = $query->get_result();
        // echo $result;
        $descr = $result->fetch_assoc()['descr'] ?? null;
        echo $descr;

        // Log the resolved description
        error_log("Resolved $type: $guid -> $descr");

        return $descr;
    }

    $table = resolveDescr($link, $tableGuid, 'table');
    $keyfield = resolveDescr($link, $keyfieldGuid, 'field');
    $listfield = resolveDescr($link, $listfieldGuid, 'field');
    $fixedList = resolveDescr($link, $fixedListGuid, 'parameter') === 'fixed_list_true';
    $allowClear = resolveDescr($link, $allowClearGuid, 'parameter') === 'allow_clear_true';

    if (!$table || !$keyfield || !$listfield) {
        http_response_code(400);
        die(json_encode(['error' => 'Invalid parameters']));
    }

    // Log validated parameters
    error_log("Validated parameters: table=$table, keyfield=$keyfield, listfield=$listfield, fixedList=$fixedList, allowClear=$allowClear");

    // Prepare queries
    try {
        // Query to get total count of matching records
        $totalQuery = $link->prepare("SELECT COUNT(*) AS total FROM `$table` WHERE `$listfield` LIKE ?");
        $searchParam = "%$search%";
        $totalQuery->bind_param('s', $searchParam);
        $totalQuery->execute();
        $totalResult = $totalQuery->get_result();
        $totalCount = $totalResult->fetch_assoc()['total'];

        // Log the total count query
        error_log("Executed query to fetch total count: search=$search, totalCount=$totalCount");

        // Query to fetch paginated records
        $dataQuery = $link->prepare("SELECT `$keyfield`, `$listfield` FROM `$table` WHERE `$listfield` LIKE ? LIMIT ? OFFSET ?");
        $dataQuery->bind_param('sii', $searchParam, $limit, $offset);
        $dataQuery->execute();
        $dataResult = $dataQuery->get_result();

        $results = [];
        while ($row = $dataResult->fetch_assoc()) {
            $results[] = $row;
        }

        // Log the fetched data
        error_log("Fetched data: " . json_encode($results));

        // Return total count and current results
        echo json_encode([
            'total' => $totalCount,
            'data' => $results,
            'fixed_list' => $fixedList,
            'allow_clear' => $allowClear
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        error_log("Error during query execution: " . $e->getMessage());
        echo json_encode(['error' => 'Query execution failed: ' . $e->getMessage()]);
    }
}

// Close the connection
$link->close();
?>
