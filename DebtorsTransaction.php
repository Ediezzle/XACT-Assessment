<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initialscale=1.0">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="xact.css" rel="stylesheet" type="text/css" />
	<title>Debtors Transactions</title>
</head>

<body>

	<br >

	<form action="Debtors_Transaction_input.php" method="post">
		<h3 class='pageCenter'> <b>Debtors Transactions</b></h3>
		<br >
		<div class="col-lg-4"> <input class="formcontrol" type="text" name="searchTerm" placeholder="Type in what you want to search for and Hit Find"> </div>
		<div class="col-lg-3"> <button class="btn btn-sm btn-info" type="submit" name="find"> Find</button> </div>

	</form>

	<form action="Debtors_Transaction_Input.php" method="post">


		<?php
		include_once 'connections.php';

		$retrieveQuery = "SELECT * FROM DebtorsTransaction";
		$res = $conn->query($retrieveQuery);

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

		foreach ($res as $row) {
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
		echo "<br >";
		echo "<h4 class='pageCenter'><strong>TOTALS</strong><h4>";
		echo "<br >";
		echo "<table class = 'table table-striped'>
                    <tr>
						<th>Vat Value</th>
                        <th align='center'>Gross Transaction Value</th>
					</tr>";

		$fetchVatTotal = "SELECT SUM(vatValue) vv FROM DebtorsTransaction";
		$executeFetchVatTotal = $conn->query($fetchVatTotal);
		foreach ($executeFetchVatTotal as $rv) {
			$doubleVatTotal = (double)($rv['vv']);
		}

		$fetchGrossTransactionTotal = "SELECT SUM(grossTransactionValue) gtv FROM DebtorsTransaction";
		$executeFetchGrossTransactionTotal = $conn->query($fetchGrossTransactionTotal);
		foreach ($executeFetchGrossTransactionTotal as $gtt) {
			$doubleGrossTransactionTotal = (double)$gtt['gtv'];
		}

		echo "<tr>";
		echo "<td>" . $doubleVatTotal . "</td>";
		echo "<td >" . $doubleGrossTransactionTotal . "</td>";
		echo "</tr>";
		echo " </table>";

		$conn->close();
		?>
	</form>

	<br >
	<br >
	<form action="Debtors_Transaction_Input.php" method="post">
		<div class="row">
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="stock" name="stock" style="border-radius: 10px;">Stock</button>
			</div>
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="stockMaster" name="stockMaster" style="border-radius: 10px;">Stock Master</button>
			</div>
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="invoiceDetail" name="invoiceDetail" style="border-radius: 10px;">Invoice Details</button>
			</div>
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="debtorsMaster" name="debtorsMaster" style="border-radius: 10px;">Debtors Master</button>
			</div>
		</div>
	</form>
</body>

</html>