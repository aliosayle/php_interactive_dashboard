<?php
include 'layouts/config.php'; // Your DB connection

$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to fetch companies based on search term
$query = "SELECT id, name FROM companies WHERE name LIKE '%$search%' LIMIT 10";
$result = mysqli_query($link, $query);
$items = [];

while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

echo json_encode(['items' => $items]);
?>
