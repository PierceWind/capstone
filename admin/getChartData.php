<?php
include ('server.php'); 

$customerLabels = array();
$customerData = array();

$query = "SELECT discount_type, COUNT(*) as count FROM transac GROUP BY discount_type";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    array_push($customerLabels, $row['discount_type']);
    array_push($customerData, $row['count']);
}

// Fetch data for the line chart
$salesLabels = array();
$salesData = array();

$query = "SELECT DATE_FORMAT(date, '%b') as month, SUM(cashPaid) as totalCashPaid FROM transac GROUP BY year(date)";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    array_push($salesLabels, $row['month']);
    array_push($salesData, $row['totalCashPaid']);
}

$data = array(
    "customerLabels" => $customerLabels,
    "customerData" => $customerData,
    "salesLabels" => $salesLabels,
    "salesData" => $salesData
);

echo json_encode($data);
?>
