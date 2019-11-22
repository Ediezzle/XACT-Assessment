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
		<h3 class = "pageCenter"><strong>Stock Master</strong></h3>
	
	<form action="Stock_Master_Input.php" method="post">
			{
				<div class="col-lg-4"> <input class="formcontrol" type="text" name="searchTerm" placeholder="Type in what you want to search for and Hit Find"> </div>
				<div class="col-lg-3"> <button class="btn btn-sm btn-info" type="submit" name="find"> Find</button> </div>
			}
		</form>
	
	<form action="StockMaster.php" method="post">
				
				
		<?php
		include_once 'connections.php';
		
		$retrieveQuery = "SELECT * FROM StockMaster";
		$res = $conn->query($retrieveQuery);
		
		
		$quantityPurchasedQuery = "SELECT quantityPurchased FROM StockMaster";
		$result = $conn->query($quantityPurchasedQuery);
		$quantityPurchased = serialize($result);
		$quantityPurchasedInt = (int)$quantityPurchased;
		
		$retrieveAll = "SELECT * FROM StockMaster";
		$retrieveResult = $conn->query($retrieveAll);
		foreach($retrieveResult as $row)
		{
			/*$quantityPurchased = $row['quantityPurchased'];
			$quantityPurchasedInt = (int)$quantityPurchased; //echo $quantityPurchasedInt; 
			echo "<br>";
			$cost = $row['cost'];
			$costInt = (int)$cost; //echo $costInt;
			$purchases = $costInt*$quantityPurchasedInt;
			//echo "<br>";
			$tpev = $purchases*0.85;
			echo $purchases;*/
		}
		
				
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

				foreach($res as $row)
				{
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
		
	
		
	$conn->close();
		?>
	</form>
</body>
</html>