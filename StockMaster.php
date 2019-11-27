<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initialscale=1.0">
	<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="xact.css" rel="stylesheet" type="text/css" />
	<title>Stock Master</title>
</head>

<body>

	<br>
	<h3 class="pageCenter"><strong>Stock Master</strong></h3>

	<form action="Stock_Master_Input.php" method="post">

		<div class="col-lg-4"> <input class="formcontrol" type="text" name="searchTerm" placeholder="Type in what you want to search for and Hit Find"> </div>
		<div class="col-lg-3"> <button class="btn btn-sm btn-info" type="submit" name="find"> Find</button> </div>

	</form>

	<form action="Stock_Master_Input.php" method="post">


		<?php
		include_once 'connections.php';

		$retrieveQuery = "SELECT * FROM StockMaster";
		$res = $conn->query($retrieveQuery);


		$quantityPurchasedQuery = "SELECT quantityPurchased FROM StockMaster";
		$result = $conn->query($quantityPurchasedQuery);
		$quantityPurchased = serialize($result);
		$quantityPurchasedInt = (int) $quantityPurchased;

		$retrieveAll = "SELECT * FROM StockMaster";
		$retrieveResult = $conn->query($retrieveAll);
		foreach ($retrieveResult as $row) { }

		echo "<table class = 'table table-striped'>
                    <tr>
					 	<th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Stock Code</th>
                        <th>Stock Description</th>
                        <th>Cost</th>
						<th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
						<th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th><button name='ascendingQuantitySold' id='ascendingQuantitySold'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantitySold'/></button>Quantity Sold<button name='descendingQuantitySold' id='descendingQuantitySold'><img src='descending.PNG' width='10' height='15' alt='descendingQuantitySold'/></button></th>
                        <th>Stock on Hand</th>
					</tr>";

		foreach ($res as $row) {
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
		echo "<h4><strong>TOTALS</strong><h4>";
		echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Cost</th>
						<th>Selling Price</th>
                        <th>Total Purchases Excluding Vat</th>
						<th>Total Sales Excluding Vat</th>
                        <th>Total Quantity Purchased</th>
                        <th>Quantity Sold</th>
                        <th>Stock on Hand</th>
					</tr>";

		$fetchCostTotal = "SELECT SUM(cost) c FROM StockMaster ";
		$executeFetchCostTotal = $conn->query($fetchCostTotal);
		foreach ($executeFetchCostTotal  as $costTotalRow) {
			$stringCostTotal = $costTotalRow['c'];
		}

		$fetchSellingPriceTotal = "SELECT SUM(sellingPrice) sp FROM StockMaster ";
		$executeFetchSellingPriceTotal = $conn->query($fetchSellingPriceTotal);
		foreach ($executeFetchSellingPriceTotal  as $sellingPriceTotalRow) {
			$stringSellingPriceTotal = $sellingPriceTotalRow['sp'];
		}

		$fetchTpev = "SELECT SUM(tpev) tp FROM StockMaster ";
		$executeTpev = $conn->query($fetchTpev);
		foreach ($executeTpev as $tpevRow) {
			$stringTpev = $tpevRow['tp'];
		}

		$fetchTsev = "SELECT SUM(tsev) ts FROM StockMaster ";
		$executeTsev = $conn->query($fetchTsev);
		foreach ($executeTsev as $tsevRow) {
			$stringTsev = $tsevRow['ts'];
		}

		$fetchQuantityPurchasedTotal = "SELECT SUM(quantityPurchased) qp FROM StockMaster ";
		$executeQuantityPurchasedTotal = $conn->query($fetchQuantityPurchasedTotal);
		foreach ($executeQuantityPurchasedTotal as $qpRow) {
			$stringQuantityPurchasedTotal = $qpRow['qp'];
		}

		$fetchQuantitySoldTotal = "SELECT SUM(quantitySold) qs FROM StockMaster ";
		$executeQuantitySoldTotal = $conn->query($fetchQuantitySoldTotal);
		foreach ($executeQuantitySoldTotal as $qsRow) {
			$stringQuantitySoldTotal = $qsRow['qs'];
		}

		$fetchStockOnHandTotal = "SELECT SUM(stockOnHand) soh FROM StockMaster ";
		$executeStockOnHandTotal = $conn->query($fetchStockOnHandTotal);
		foreach ($executeStockOnHandTotal as $sohRow) {
			$stringStockOnHandTotal = $sohRow['soh'];
		}

		echo "<tr>";
		echo "<td>" . $stringCostTotal . "</td>";
		echo "<td>" . $stringSellingPriceTotal . "</td>";
		echo "<td>" . $stringTpev . "</td>";
		echo "<td>" . $stringTsev . "</td>";
		echo "<td>" . $stringQuantityPurchasedTotal . "</td>";
		echo "<td>" . $stringQuantitySoldTotal . "</td>";
		echo "<td>" . $stringStockOnHandTotal . "</td>";
		echo "</tr>";
		echo " </table>";



		$conn->close();
		?>
	</form>

	<br>
	<br>


	<form action="Stock_Master_Input.php" method="post">
		<div class="row">
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="stock" name="stock" style="border-radius: 10px;">Stock</button>
			</div>
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="invoiceDetail" name="invoiceDetail" style="border-radius: 10px;">Invoice Details</button>
			</div>
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="debtorsTransaction" name="debtorsTransaction" style="border-radius: 10px;">Debtors Transaction</button>
			</div>
			<div class="col-lg-3">
				<button class="btn btn-info btn-sm form-control" id="debtorsMaster" name="debtorsMaster" style="border-radius: 10px;">Debtors Master</button>
			</div>
		</div>
	</form>
</body>

</html>