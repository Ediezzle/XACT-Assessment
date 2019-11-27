<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initialscale=1.0">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="xact.css" rel="stylesheet" type="text/css" />
	<title>Debtors Master</title>
</head>

<body>
	<h3 class="pageCenter"> <b>Debtors Master</b></h3>
	<br>
	<?php
	include_once 'connections.php';
	echo "<form method='post' action='Debtors_Master_Input.php'>
			 
                <table class = 'table table-striped'>
                    <tr>
                        <th>Account Code</th>
                        <th>Name</th>
                        <th name='address1'>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Cost Year To Date</th>
						<th><button name='ascendingSYTD' id='ascendingSYTD'><img src='ascending.PNG' width='10' height='15' alt='ascendingSYTD'/></button>Sales Year To Date<button name='descendingSYTD' id='descendingSYTD'><img src='descending.PNG' width='10' height='15' alt='descendingSYTD'/></button></th>
                        <th>Paid</th>
						<th><button name='ascendingBal' id='ascendingBal'><img src='ascending.PNG' width='10' height='15' alt='ascendingBal'/></button>Balance<button name='descendingBal' id='descendingBal'><img src='descending.PNG' width='10' height='15' alt='descendingBal'/></button></th>
						<th>Edit</th>
						<th>Delete</th>
					 </tr>";
	$retrieveq = "SELECT * FROM DebtorsMaster";
	$result = $conn->query($retrieveq);


	//if (is_array($result) || is_object($result)) {
	foreach ($result as $row) {
		$balance = $row['costYearToDate'] - $row['paid'];
		echo "<td>" . $row['accCode'] . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['address1'] . "</td>";
		echo "<td>" . $row['address2'] . "</td>";
		echo "<td>" . $row['address3'] . "</td>";
		echo "<td>" . $row['costYearToDate'] . "</td>";
		echo "<td>" . $row['salesYearToDate'] . "</td>";
		echo "<td>" . $row['paid'] . "</td>";
		echo "<td>" . $row['balance'] . "</td>";
		echo "<td><b><a href='Debtors_Master_Input.php?accCode={$row['accCode']}'>Edit</a></b></td>";
		echo "<td><b><a href='Debtors_Master_Input.php?id={$row['accCode']}'>Delete</a></b></td>";
		echo "</tr>";
	}
	//}
	echo " </table>";
	echo "</form>";
	echo "<h4><strong>TOTALS</strong><h4>";
	echo   "<table class = 'table table-striped'>
                    <tr>
                        <th>Cost Year To Date</th>
						<th>Sales Year To Date</th>
                        <th>Paid</th>
						<th>Balance</th>
					 </tr>";
	$retrieveq = "SELECT * FROM DebtorsMaster";
	$result = $conn->query($retrieveq);

	$fetchCostYearToDateTotal = "SELECT SUM(costYearToDate) cytd FROM DebtorsMaster ";
	$executeFetchCostYearToDateTotal = $conn->query($fetchCostYearToDateTotal);
	foreach ($executeFetchCostYearToDateTotal as $rcytd) {
		$stringCostYearToDateTotal = $rcytd['cytd'];
	}

	$fetchSalesYearToDateTotal = "SELECT SUM(salesYearToDate) sytd FROM DebtorsMaster ";
	$executeFetchSalesYearToDateTotal = $conn->query($fetchSalesYearToDateTotal);
	foreach ($executeFetchSalesYearToDateTotal as $rsytd) {
		$stringSalesYearToDateTotal = $rsytd['sytd'];
	}

	$fetchPaidTotal = "SELECT SUM(paid) p FROM DebtorsMaster ";
	$executeFetchPaidTotal = $conn->query($fetchPaidTotal);
	foreach ($executeFetchPaidTotal as $rp) {
		$stringPaidTotal = $rp['p'];
	}

	$balance = $stringCostYearToDateTotal - $stringPaidTotal;
	echo "<tr>";
	echo "<td>" . $stringCostYearToDateTotal . "</td>";
	echo "<td>" . $stringSalesYearToDateTotal . "</td>";
	echo "<td>" . $stringPaidTotal . "</td>";
	echo "<td>" . $balance . "</td>";
	echo "</tr>";
	echo " </table>";



	$conn->close();
	?>
	<br>
	<br>
	<form action="Debtors_Master_Input.php" method="post">
		<div class="row">
			<div class="col-lg-1">

			</div>
			<div class="col-lg-2">
				<button class="btn btn-info btn-sm form-control" id="search" name="search" style="border-radius: 10px;">Search</button>
			</div>

			<div class="col-lg-2">
				<button class="btn btn-info btn-sm form-control" id="stock" name="stock" style="border-radius: 10px;">Stock</button>
			</div>
			<div class="col-lg-2">
				<button class="btn btn-info btn-sm form-control" id="stockMaster" name="stockMaster" style="border-radius: 10px;">Stock Master</button>
			</div>
			<div class="col-lg-2">
				<button class="btn btn-info btn-sm form-control" id="debtorsTransaction" name="debtorsTransaction" style="border-radius: 10px;">Debtors Transaction</button>
			</div>
			<div class="col-lg-2">
				<button class="btn btn-info btn-sm form-control" id="invoiceDetail" name="invoiceDetail" style="border-radius: 10px;">Invoice Details</button>
			</div>
			<div class="col-lg-1">

			</div>
		</div>
	</form>
</body>
<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

</html>