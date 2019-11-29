<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initialscale=1.0">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="xact.css" rel="stylesheet" type="text/css" />
	<title>Debtors Transaction Input</title>
</head>

<body>
	<?php
	//Referencing the 'connections' file which contains the code to establish a connection to the database
	include_once 'connections.php';

	//checking if button with name 'find' has been clicked and displayig the seacrh results if it has.
	if (isset($_POST['find'])) {
		$st = $_POST['searchTerm'];
		$searchq = " SELECT DISTINCT * FROM DebtorsTransaction
    WHERE date LIKE '%$st%' 
    OR name LIKE '%$st%'
    OR accCode LIKE '%$st%'
    OR transactionType LIKE '%$st%'
    OR invoiceNumber LIKE '%$st%'
    OR grossTransactionValue LIKE '%$st%'
    OR vatValue LIKE '%$st%'";

		$result = $conn->query($searchq);
		echo "<h3 class='pageCenter'> <b>Debtors Transactions</b></h3>
		<br >";
		echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Invoice Number</th>
						<th>Vat Value</th>
                        <th>Gross Transaction Value</th>
					</tr>";

		foreach ($result  as $row) {

			echo "<tr>";
			echo "<td>" . $row['date'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['accCode'] . "</td>";
			echo "<td>" . $row['transactionType'] . "</td>";
			echo "<td>" . $row['invoiceNumber'] . "</td>";
			echo "<td>" . $row['vatValue'] . "</td>";
			echo "<td align='center'>" . $row['grossTransactionValue'] . "</td>";
			echo "</tr>";
		}
		echo " </table>";
	}

	//sorting in descending order using date
	elseif (isset($_POST['descending'])) {
		$retrieveq = "SELECT * FROM DebtorsTransaction ORDER BY date DESC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action='Debtors_Transaction_Input.php'>";
		echo "<h3 class='pageCenter'> <b>Debtors Transactions</b></h3>
		<br >";
		echo "<table class = 'table table-striped'>
                    <tr>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Name</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Invoice Number</th>
						<th>Vat Value</th>
                        <th align='center'><button name='ascendingGTV' id='ascendingGTV'><img src='ascending.PNG' width='10' height='15' alt='ascendingGTV'/></button>Gross Transaction Value<button name='descendingGTV' id='descendingGTV'><img src='descending.PNG' width='10' height='15' alt='descendingGTV'/></button></th>
					</tr>";


		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['accCode'] . "</td>";
				echo "<td>" . $row['transactionType'] . "</td>";
				echo "<td>" . $row['invoiceNumber'] . "</td>";
				echo "<td>" . $row['vatValue'] . "</td>";
				echo "<td align='center'>" . $row['grossTransactionValue'] . "</td>";
				echo "</tr>";
			}
		}
		echo " </table>";
		echo "</form>";
	}

	//sorting in ascending order of date
	elseif (isset($_POST['ascending'])) {
		$retrieveq = "SELECT * FROM DebtorsTransaction ORDER BY date ASC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action='Debtors_Transaction_Input.php'>";
		echo "<h3 class='pageCenter'> <b>Debtors Transactions</b></h3>
		<br >";
		echo "<table class = 'table table-striped'>
                   <tr>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Name</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Invoice Number</th>
						<th>Vat Value</th>
                        <th align='center'><button name='ascendingGTV' id='ascendingGTV'><img src='ascending.PNG' width='10' height='15' alt='ascendingGTV'/></button>Gross Transaction Value<button name='descendingGTV' id='descendingGTV'><img src='descending.PNG' width='10' height='15' alt='descendingGTV'/></button></th>
					</tr>";

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['accCode'] . "</td>";
				echo "<td>" . $row['transactionType'] . "</td>";
				echo "<td>" . $row['invoiceNumber'] . "</td>";
				echo "<td>" . $row['vatValue'] . "</td>";
				echo "<td align='center'>" . $row['grossTransactionValue'] . "</td>";
				echo "</tr>";
			}
		}
		echo " </table>";
		echo "</form>";
	}

	//sorting in ascending order of Sales Gross Total Value
	elseif (isset($_POST['ascendingGTV'])) {
		$retrieveq = "SELECT * FROM DebtorsTransaction ORDER BY grossTransactionValue ASC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action='Debtors_Transaction_Input.php'>";
		echo "<h3 class='pageCenter'> <b>Debtors Transactions</b></h3>
		<br >";
		echo "<table class = 'table table-striped'>
                    <tr>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Name</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Invoice Number</th>
						<th>Vat Value</th>
                        <th align='center'><button name='ascendingGTV' id='ascendingGTV'><img src='ascending.PNG' width='10' height='15' alt='ascendingGTV'/></button>Gross Transaction Value<button name='descendingGTV' id='descendingGTV'><img src='descending.PNG' width='10' height='15' alt='descendingGTV'/></button></th>
					</tr>";

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['accCode'] . "</td>";
				echo "<td>" . $row['transactionType'] . "</td>";
				echo "<td>" . $row['invoiceNumber'] . "</td>";
				echo "<td>" . $row['vatValue'] . "</td>";
				echo "<td align='center'>" . $row['grossTransactionValue'] . "</td>";
				echo "</tr>";

				echo "</tr>";
			}
		}
		echo " </table>";
		echo "</form>";
	}

	//sorting in descending order of Sales Gross Total Value
	elseif (isset($_POST['descendingGTV'])) {
		$retrieveq = "SELECT * FROM DebtorsTransaction ORDER BY grossTransactionValue DESC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action=Debtors_Transaction_Input.php>";
		echo "<h3 class='pageCenter'> <b>Debtors Transactions</b></h3>
		<br >";
		echo "<table class = 'table table-striped'>
                    <tr>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Name</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Invoice Number</th>
						<th>Vat Value</th>
                        <th align='center'><button name='ascendingGTV' id='ascendingGTV'><img src='ascending.PNG' width='10' height='15' alt='ascendingGTV'/></button>Gross Transaction Value<button name='descendingGTV' id='descendingGTV'><img src='descending.PNG' width='10' height='15' alt='descendingGTV'/></button></th>
					</tr>";

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				echo "<tr>";
				echo "<td>" . $row['date'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['accCode'] . "</td>";
				echo "<td>" . $row['transactionType'] . "</td>";
				echo "<td>" . $row['invoiceNumber'] . "</td>";
				echo "<td>" . $row['vatValue'] . "</td>";
				echo "<td align='center'>" . $row['grossTransactionValue'] . "</td>";
				echo "</tr>";
			}
		}
		echo " </table>";
		echo "</form>";
	}

	//checking whcich button has been clicked and directing to the respective locations
	elseif (isset($_POST['stock'])) {
		header("Location: Stock.php");
	} elseif (isset($_POST['stockMaster'])) {
		header("Location: StockMaster.php");
	} elseif (isset($_POST['invoiceDetail'])) {
		header("Location: InvoiceDetail.php");
	} elseif (isset($_POST['debtorsMaster'])) {
		header("Location: DebtorsMaster.php");
	}

	//terminating connection with database	
	$conn->close();
	?>

	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
</body>

</html>