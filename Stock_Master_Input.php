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
	
	//referencing the file which contains code for establishing a connection to the database
	include_once 'connections.php';

	//displaying search results
	if (isset($_POST['find'])) {
		$st = $_POST['searchTerm'];
		$searchq = " SELECT DISTINCT * FROM StockMaster
    WHERE date LIKE '%$st%'
	OR stockCode LIKE '%$st%' 
    OR description LIKE '%$st%'
    OR cost LIKE '%$st%'
    OR sellingPrice LIKE '%$st%'
    OR tpev LIKE '%$st%'
    OR tsev LIKE '%$st%'
    OR quantityPurchased LIKE '%$st%'
    OR quantitySold LIKE '%$st%'
    OR stockOnHand LIKE '%$st%'";
		$result = $conn->query($searchq);

		echo "<h3 class='pageCenter'> Stock Master</h3>
                <br>";
		echo "<table class = 'table table-striped'>
                    <tr>
						<th>Date</th>
                        <th>Stock Description</th>
                        <th>Cost</th>
						<th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
						<th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th>Quantity Sold</th>
                        <th>Stock on Hand</th>
					</tr>";

		foreach ($result  as $row) {

			echo "<tr>";
			echo "<td>" . $row['date'] . "</td>";
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
	
	//sorting by date in descending order
	elseif (isset($_POST['descending'])) {
		$retrieveq = "SELECT * FROM StockMaster ORDER BY date DESC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action=Stock_Master_Input.php>";
		echo "<h3 class='pageCenter'>Stock Master</h3>
                <br>";
		echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Stock Code</th>
                        <th>Stock Description</th>
						<th>Cost</th>
                        <th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
                        <th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th>Quantity Sold<button name='ascendingQuantitySold' id='ascendingQuantitySold'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantitySold'/></button><button name='descendingQuantitySold' id='descendingQuantitySold'><img src='descending.PNG' width='10' height='15' alt='descendingQuantitySold'/></button></th>
                        <th>Stock On Hand</th>
 					</tr>";

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
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
		}
		echo " </table>";
		echo "</form>";
	} 
	
	//sorting by date in ascending order
	elseif (isset($_POST['ascending'])) {
		$retrieveq = "SELECT * FROM StockMaster ORDER BY date ASC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action='Stock_Master_Input.php'>";
		echo "<h3 class='pageCenter'> Stock Master</h3>
                <br>";
		echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Stock Code</th>
                        <th>Stock Description</th>
						<th>Cost</th>
                        <th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
                        <th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th>Quantity Sold<button name='ascendingQuantitySold' id='ascendingQuantitySold'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantitySold'/></button><button name='descendingQuantitySold' id='descendingQuantitySold'><img src='descending.PNG' width='10' height='15' alt='descendingQuantitySold'/></button></th>
                        <th>Stock On Hand</th>
                        
						 
 					</tr>";

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
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
		}
		echo " </table>";
		echo "</form>";
	} 
	
	//sorting by quantity sold in ascending order
	elseif (isset($_POST['ascendingQuantitySold'])) {
		$retrieveq = "SELECT * FROM StockMaster ORDER BY quantitySold ASC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action='Stock_Master_Input.php'>";
		echo "<h3 class='pageCenter'> Stock Master</h3>
                <br>";
		echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Stock Code</th>
                        <th>Stock Description</th>
						<th>Cost</th>
                        <th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
                        <th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th>Quantity Sold<button name='ascendingQuantitySold' id='ascendingQuantitySold'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantitySold'/></button><button name='descendingQuantitySold' id='descendingQuantitySold'><img src='descending.PNG' width='10' height='15' alt='descendingQuantitySold'/></button></th>
                        <th>Stock On Hand</th>
 					</tr>";

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
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
				echo "</tr>";
			}
		}
		echo " </table>";
		echo "</form>";
	} 
	
	//sorting by quantity sold in descending order
	elseif (isset($_POST['descendingQuantitySold'])) {
		$retrieveq = "SELECT * FROM StockMaster ORDER BY quantitySold DESC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action=Stock_Master_Input.php>";
		echo "<h3 class='pageCenter'> Stock Master</h3>
                <br>";
		echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Stock Code</th>
                        <th>Stock Description</th>
						<th>Cost</th>
                        <th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
                        <th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th>Quantity Sold<button name='ascendingQuantitySold' id='ascendingQuantitySold'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantitySold'/></button><button name='descendingQuantitySold' id='descendingQuantitySold'><img src='descending.PNG' width='10' height='15' alt='descendingQuantitySold'/></button></th>
                        <th>Stock On Hand</th>
 					</tr>";

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
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
		}
		echo " </table>";
		echo "</form>";
	} 
	
	//redirecting to the respective pages
	elseif (isset($_POST['stock'])) {
		header("Location: Stock.php");
	} elseif (isset($_POST['invoiceDetail'])) {
		header("Location: InvoiceDetail.php");
	} elseif (isset($_POST['debtorsTransaction'])) {
		header("Location: DebtorsTransaction.php");
	} elseif (isset($_POST['debtorsMaster'])) {
		header("Location: DebtorsMaster.php");
	}

	//terminating connection with the database
	$conn->close();
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
</body>

</html>