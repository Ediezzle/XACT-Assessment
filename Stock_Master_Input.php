<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initialscale=1.0">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="xact.css" rel="stylesheet" type="text/css" />
<title>Stock Master Input</title>
</head>

<body>
	<?php
	include_once 'connections.php';
	
	if (isset($_POST['find'])) {
                $st = $_POST['searchTerm'];
                $searchq = " SELECT DISTINCT * FROM StockMaster
    WHERE stockCode LIKE '%$st%' 
     OR description LIKE '%$st%'
    OR cost LIKE '%$st%'
    OR sellingPrice LIKE '%$st%'
    OR tpev LIKE '%$st%'
    OR tsev LIKE '%$st%'
    OR quantityPurchased LIKE '%$st%'
    OR quantitySold LIKE '%$st%'
    OR stockOnHand LIKE '%$st%'";
                $result = $conn->query($searchq);

                echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Stock Code</th>
                        <th>Stock Description</th>
                        <th>Cost</th>
						<th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
						<th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th>Total Quantity Sold</th>
                        <th>Stock on Hand</th>
					</tr>";
		
                foreach ($result  as $row) {

                    echo "<tr>";
                    echo "<tr>";
					echo "<td>" . $row['stockCode'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
					echo "<td>" . $row['cost'] . "</td>";
					echo "<td>" . $row['sellingPrice'] . "</td>";
					echo "<td>" . $row['tpev'] . "</td>";
					echo "<td>" . $row['tsev'] . "</td>";
					echo "<td>" . $row['quantityPurchased'] . "</td>";
					echo "<td>" . $row['quantitySold'] . "</td>";
					echo "<td>" . $row['stockOnHand'] . "</td>";
					echo "</tr>";
                }
                echo " </table>";
	}
$conn->close();		
?>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
</body>
</html>