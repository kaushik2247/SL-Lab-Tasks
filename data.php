<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemCodes = explode(",", $_POST['itemCodes']);
    $itemNames = explode(",", $_POST['itemNames']);
    $unitsSold = explode(",", $_POST['unitsSold']);
    $rates = explode(",", $_POST['rates']);

    echo "<!DOCTYPE html><html><head><title>Bill Details</title></head><body>";
    echo "<h2>Bill Details</h2>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>
<th>Item Code</th>
<th>Item Name</th>
<th>Units Sold</th>
<th>Rate</th>
<th>Total</th>
</tr>";
    $totalBill = 0;
    for ($i = 0; $i < count($itemCodes); $i++) {
        $code = trim($itemCodes[$i]);
        $name = trim($itemNames[$i]);
        $units = (float)trim($unitsSold[$i]);
        $rate = (float)trim($rates[$i]);
        $total = $units * $rate;
        $totalBill += $total;
        echo "<tr>
<td>{$code}</td>
<td>{$name}</td>
<td>{$units}</td>
<td>{$rate}</td>
<td>{$total}</td>
</tr>";
    }
    echo "<tr>
<td colspan='4' style='text-align: right;'><strong>Grand Total</strong></td>
<td><strong>{$totalBill}</strong></td>
</tr>";
    echo "</table>";
    echo "</body></html>";
}
?>
