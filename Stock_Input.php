 <html>

 <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="xact.css" rel="stylesheet" type="text/css" />
    <title>Stock_Input</title>
 </head>

 <body>

     <?php
        //$subtotal=200;
        include_once 'connections.php';
        if (isset($_POST['save'])) {
            $stockCode = $_POST['stockCode'];
            $date = $_POST['date'];
            $transactionType = $_POST['transactionType'];
            $documentNumber = $_POST['documentNumber'];
            $quantity = $_POST['quantity'];
            $unitCost = $_POST['unitCost'];
            $unitSell = $_POST['unitSell'];
			$description = $_POST['description'];

            $insertq = "INSERT INTO Stock VALUES('$stockCode','$date', '$transactionType', '$documentNumber', '$quantity', '$unitCost', '$unitSell', '$description')";
			$result = $conn->query($insertq);
			$tpev = $quantity*$unitCost*0.85;
			$stockOnHand=$unitCost*$quantity;
			
			$updateStockMaster = "INSERT INTO StockMaster (date, stockCode, description, cost, sellingPrice, quantityPurchased, tpev, stockOnHand) VALUES ('$date', '$stockCode', '$description', '$unitCost', '$unitSell', '$quantity', $tpev, $stockOnHand) ON DUPLICATE KEY UPDATE date='$date', description='$description', cost=cost+$unitCost*$quantity, sellingPrice=sellingPrice+$unitSell*$quantity, quantityPurchased=quantityPurchased+$quantity, tpev=tpev+$tpev, stockOnHand=stockOnHand+$stockOnHand";
			$res=$conn->query($updateStockMaster);
			if($res===TRUE)
			{
				echo "Updated stock master!";
				echo "<br>";
			}
			
			if($res===FALSE)
			{
				echo "Ooops!".$conn->error;
				echo "<br>";
			}
			
            if ($result === TRUE) {
                echo "<p>Record(s) have been saved successfully!</p>";
				echo "<br>";
              } 
			
			if($result===FALSE) {
                echo "Error adding record(s)!: " . $conn->error;
				echo "<br>";
            }
			
            echo "<br>";
        } 
	 /*
	 elseif (isset($_POST['nextItem'])) {
            $stockCode = $_POST['stockCode'];
            $date = $_POST['date'];
            $transactionType = $_POST['transactionType'];
            $documentNumber = $_POST['documentNumber'];
            $quantity = $_POST['quantity'];
            $unitCost = $_POST['unitCost'];
            $unitSell = $_POST['unitSell'];
			$description = $_POST['description'];

            $insertq = "INSERT INTO Stock VALUES('$stockCode','$date', '$transactionType', '$documentNumber', '$quantity', '$unitCost', '$unitSell', '$description')";
			$result = $conn->query($insertq);

        }
	 */ 
	 elseif (isset($_POST['search'])) {
            ?>
         <form method='POST' action="<?php echo $_SERVER['PHP_SELF'];  ?>">
             <br />
             <br />
             <div class="row container">
                 <div class="col-lg-4"> <input class="formcontrol" type="text" name="searchTerm" placeholder="Type in what you want to search for and Hit Find"> </div>
                 <div class="col-lg-3"> <button class="btn btn-sm btn-info" type="submit" name="find"> Find</button> </div>
             </div>
         </form>
         <?php
            } 
	 
	 elseif (isset($_POST['find'])) {
                $st = $_POST['searchTerm'];
                $searchq = " SELECT DISTINCT * FROM Stock
    WHERE stockCode LIKE '%$st%' 
    OR date LIKE '%$st%'
    OR stockCode LIKE '%$st%'
    OR transactionType LIKE '%$st%'
    OR documentNumber LIKE '%$st%'
    OR quantity LIKE '%$st%'
    OR unitCost LIKE '%$st%'
    OR unitSell LIKE '%$st%'
	OR description LIKE '%$st%'
    LIMIT 0 , 30";
                $result = $conn->query($searchq);
		 		echo "<form method='post' action='Stock_Input.php'>
                 <table class = 'table table-striped'>
                    <tr>
                     	<th><strong>Stock Code</strong></th>
						<th><strong>Date</strong></th>
						<th><strong>Transaction Type</strong></th>
						<th><strong>Document Number</strong></th>
						<th><strong>Quantity</strong></th>
						<th><strong>Unit Cost</strong></th>
						<th><strong>Unit Sell</strong></th>
						<th><strong>Description</strong></th>
					</tr>";
					
			
                foreach ($result as $row) {

                    echo "<tr>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
                    echo "</tr>";
                }
                echo " </table>";
		 echo "</form>";
			
            } 
	 
	 
	 elseif (isset($_POST['descending'])) {
                $retrieveq = "SELECT * FROM Stock ORDER BY date DESC";
                $result = $conn->query($retrieveq);
		 echo "<form method='post' action=Stock_Input.php>";
                echo "<table class = 'table table-striped'>
                    <tr align='center'>
                        <th>stockCode</th>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>TransactionType</th>
                        <th>DocumentNumber</th>
                        <th><button name='ascendingQuantity' id='ascendingQuantity'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantity'/></button>Quantity<button name='descendingQuantity' id='descendingQuantity'><img src='descending.PNG' width='10' height='15' alt='descendingQuantity'/></button></th>
                        <th>Unit Cost</th>
						<th>Total Cost Cost</th>
                        <th>Unit Sell</th>
						<th>Description</th>
						<th>Edit</th>
						<th>Delete</th>
					 </tr>";

		 		if(is_array($result) || is_object($result))
				{
                foreach ($result as $row) {
					$totalCost = $row['quantity'] * $row['unitCost'];
                    echo "<tr align='center'>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
					echo "<td>" . $totalCost . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
                    echo "<td><b><a href='Stock_Input.php?stockId={$row['stockCode']}'>Edit</a></b></td>";
             		echo "<td><b><a href='Stock_Input.php?id={$row['stockCode']}'>Delete</a></b></td>";

					
        echo "</tr>";
   }
}
   echo " </table>";
		 echo "</form>";
 } 
	 
	 elseif (isset($_POST['descendingQuantity'])) {
                $retrieveq = "SELECT * FROM Stock ORDER BY quantity DESC";
                $result = $conn->query($retrieveq);
		 echo "<form method='post' action=Stock_Input.php>";
                echo "<table class = 'table table-striped'>
                    <tr align='center'>
                        <th>stockCode</th>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>TransactionType</th>
                        <th>DocumentNumber</th>
                        <th><button name='ascendingQuantity' id='ascendingQuantity'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantity'/></button>Quantity<button name='descendingQuantity' id='descendingQuantity'><img src='descending.PNG' width='10' height='15' alt='descendingQuantity'/></button></th>
                        <th>Unit Cost</th>
						<th>Total Cost Cost</th>
                        <th>Unit Sell</th>
						<th>Description</th>
						<th>Edit</th>
						<th>Delete</th>
					 </tr>";

		 		if(is_array($result) || is_object($result))
				{
                foreach ($result as $row) {
					$totalCost = $row['quantity'] * $row['unitCost'];
                    echo "<tr align='center'>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
					echo "<td>" . $totalCost . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
                    echo "<td><b><a href='Stock_Input.php?stockId={$row['stockCode']}'>Edit</a></b></td>";
             		echo "<td><b><a href='Stock_Input.php?id={$row['stockCode']}'>Delete</a></b></td>";

					
        echo "</tr>";
   }
}
   echo " </table>";
		 echo "</form>";
 }
	 
	 elseif (isset($_POST['ascending'])) {
                $retrieveq = "SELECT * FROM Stock ORDER BY date ASC";
                $result = $conn->query($retrieveq);
		 echo "<form method='post' action='Stock_Input.php'>";
                echo "<table class = 'table table-striped'>
                    <tr align='center'>
                        <th>stockCode</th>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>TransactionType</th>
                        <th>DocumentNumber</th>
                        <th><button name='ascendingQuantity' id='ascendingQuantity'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantity'/></button>Quantity<button name='descendingQuantity' id='descendingQuantity'><img src='descending.PNG' width='10' height='15' alt='descendingQuantity'/></button></th>
                        <th>Unit Cost</th>
						<th>Total Cost Cost</th>
                        <th>Unit Sell</th>
						<th>Description</th>
						<th>Edit</th>
						<th>Delete</th>
					 </tr>";

		 		if(is_array($result) || is_object($result))
				{
                foreach ($result as $row) {
					$totalCost = $row['quantity'] * $row['unitCost'];
                    echo "<tr align='center'>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
					echo "<td>" . $totalCost . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
                    echo "<td><b><a href='Stock_Input.php?stockId={$row['stockCode']}'>Edit</a></b></td>";
             		echo "<td><b><a href='Stock_Input.php?id={$row['stockCode']}'>Delete</a></b></td>";

					
        echo "</tr>";
   }
}
   echo " </table>";
		 echo "</form>";
 } 
	 
	 elseif (isset($_POST['ascendingQuantity'])) {
                $retrieveq = "SELECT * FROM Stock ORDER BY quantity ASC";
                $result = $conn->query($retrieveq);
		 echo "<form method='post' action='Stock_Input.php'>";
                echo "<table class = 'table table-striped'>
                    <tr align='center'>
                        <th>stockCode</th>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>TransactionType</th>
                        <th>DocumentNumber</th>
                        <th><button name='ascendingQuantity' id='ascendingQuantity'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantity'/></button>Quantity<button name='descendingQuantity' id='descendingQuantity'><img src='descending.PNG' width='10' height='15' alt='descendingQuantity'/></button></th>
                        <th>Unit Cost</th>
						<th>Total Cost Cost</th>
                        <th>Unit Sell</th>
						<th>Description</th>
						<th>Edit</th>
						<th>Delete</th>
					 </tr>";

		 		if(is_array($result) || is_object($result))
				{
                foreach ($result as $row) {
					$totalCost = $row['quantity'] * $row['unitCost'];
                    echo "<tr align='center'>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
					echo "<td>" . $totalCost . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
                    echo "<td><b><a href='Stock_Input.php?stockId={$row['stockCode']}'>Edit</a></b></td>";
             		echo "<td><b><a href='Stock_Input.php?id={$row['stockCode']}'>Delete</a></b></td>";

					
        echo "</tr>";
   }
}
   echo " </table>";
		 echo "</form>";
 } 
	 
	  elseif (isset($_POST['open'])) {
                $retrieveq = "SELECT * FROM Stock";
                $result = $conn->query($retrieveq);
		 
		  echo "<form method='post' action='Stock_Input.php'>
			 
                <table class = 'table table-striped'>
                    <tr align='center'>
                        <th>stockCode</th>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='ascending'/></button></th>
                        <th>TransactionType</th>
                        <th>DocumentNumber</th>
                        <th><button name='ascendingQuantity' id='ascendingQuantity'><img src='ascending.PNG' width='10' height='15' alt='ascendingQuantity'/></button>Quantity<button name='descendingQuantity' id='descendingQuantity'><img src='descending.PNG' width='10' height='15' alt='dscendingQuantity'/></button></th>
                        <th>Unit Cost</th>
						<th>Total Cost Cost</th>
                        <th>Unit Sell</th>
						<th>Description</th>
						<th>Edit</th>
						<th>Delete</th>
					 </tr>";

		 		if(is_array($result) || is_object($result))
				{
                foreach ($result as $row) {
					$totalCost = $row['quantity'] * $row['unitCost'];
                    echo "<tr align='center'>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
					echo "<td>" . $totalCost . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
                    echo "<td><b><a href='Stock_Input.php?stockId={$row['stockCode']}'>Edit</a></b></td>";
             		echo "<td><b><a href='Stock_Input.php?id={$row['stockCode']}'>Delete</a></b></td>";

					
        echo "</tr>";
   }
}
   echo " </table>";
		  echo "</form>";
 } 
	 
	 elseif (isset($_GET['id'])) {
$id = $_REQUEST['id'];
  $retrieveq = "SELECT * FROM Stock WHERE stockCode='$id'";
 $result = $conn->query($retrieveq);
			
			echo "<table class = 'table table-striped'>
                    <tr>
                        <th>stockCode</th>
                        <th>Date</th>
                        <th>TransactionType</th>
                        <th>DocumentNumber</th>
                        <th>Quantity</button></th>
                        <th>Unit Cost</th>
						<th>Total Cost</th>
                        <th>Unit Sell</th>
						<th>Description</th>
						<th>Delete</th>
					</tr>";
		 		
                foreach ($result as $row) {
					$totalCost = $row['quantity'] * $row['unitCost'];
                    echo "<tr>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
					echo "<td>" . $totalCost . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
             		echo "<td><b><a href='Stock_Input.php?del={$row['stockCode']}'>Confirm</a></b></td>";
        			echo "</tr>";
					
					
   }
		 
   echo " </table>";
 }
	 
	 elseif (isset($_GET['del'])) {
                        $del = $_GET['del'];
                     
							$deleteq = "DELETE FROM Stock WHERE stockCode='$del'";
                        	$result = $conn->query($deleteq);
		 				if($result===TRUE)
							echo "Entire record successfully deleted!";
		 				else
							echo "Ooops!".$conn->error;
						
                    }
	 	 
	 elseif(isset($_GET['stockId']))
	 {
		 $id = $_REQUEST['stockId'];
  $retrieveq = "SELECT * FROM Stock WHERE stockCode='$id'";
 $result = $conn->query($retrieveq);
			
			echo "<table class = 'table table-striped'>
                    <tr>
                        <th>stockCode</th>
                        <th>Date</th>
                        <th>TransactionType</th>
                        <th>DocumentNumber</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
						<th>Total Cost</th>
                        <th>Unit Sell</th>
						<th>Description</th>
						<th>Edit</th>
					</tr>";

                foreach ($result as $row) {
					$totalCost = $row['quantity'] * $row['unitCost'];
                    echo "<tr>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
                    echo "<td>" . $row['documentNumber'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
					echo "<td>" . $totalCost . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
             		echo "<td><b><a href='Stock_Input.php?ed={$row['stockCode']}'>Confirm</a></b></td>";
        			echo "</tr>";
   }
		 
   echo " </table>";
	 }
	 
	 elseif(isset($_GET['ed']))
	 {
		 $id = $_GET['ed'];
		 $retrieveq = "SELECT * FROM Stock WHERE stockCode='$id'";
 		 $result = $conn->query($retrieveq);
		 //$row = (array)$result;
	$row = $result->fetch_array();
		?>
          
         <form action="Stock_Input.php" method="post">
        <div class="container-fluid bg-info">
            <h3 class="pageCenter"> Stock Details</h3>
            <br>
            <div class="row"  style="text-align:center">
                <div class="col-lg-1"> <strong>Stock Code</strong></div>
                <div class="col-lg-2"> <strong>Date</div></strong>
                <div class="col-lg-1"> <strong>Transaction Type</strong></div>
                <div class="col-lg-1"> <strong>Document Number</strong></div>
                <div class="col-lg-1"> <strong>Quantity</strong></div>
                <div class="col-lg-1"> <strong>Unit Cost</strong></div>
				<div class="col-lg-1"> <strong>Total Cost</strong></div>
                <div class="col-lg-1"> <strong>Unit Sell</strong></div>
				<div class="col-lg-3"> <strong>Description</strong></div>
                

            </div>
            <div class="row">
                <div class="col-lg-1"><input type="text" name="stockCode" id="stockCode" class="form-control" required value="<?php echo $row['0'];?>"/>
                </div>
                <div class="col-lg-2"><input type="date" name="date" id="date" class="form-control" required value="<?php echo $row[1];?>"/>
                </div>
                <div class="col-lg-1">
					
						<label for="transLab" ></label>
							<select class="form-control" id="transactionType" name="transactionType" value="<?php echo $row[2];?>" style="margin-top: -4%;">
								<option>Cash</option>
								<option>Credit</option>
							</select>
					
                </div>
                <div class="col-lg-1"><input type="text" name="documentNumber" id="documentNumber" class="form-control" required value="<?php echo $row[3];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="quantity" id="quantity" class="form-control" required value="<?php echo $row[4];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="unitCost" id="unitCost" class="form-control" required value="<?php echo $row[5];?>"/>
                </div>
				<div class="col-lg-1"><input type="text" name="totalCost" id="totalCost" class="form-control" disabled value="<?php echo $row[4]*$row[5];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="unitSell" id="unitSell" class="form-control" required value="<?php echo $row[6];?>"/>
                </div>
				<div class="col-lg-3"><input type="text" name="description" id="description" class="form-control" required value="<?php echo $row[7];?>"/>
                </div>
                

            </div>
            <br />

            <div class="row">
                <div class="col-lg-3">
                    <a href="InvoiceDetail.php"> <button class="btn btn-info btn-sm formcontrol" id="update" name="update">Update</button></a>
                </div>
                <div class=" col-lg-3">
                    <button class="btn btn-info btn-sm form-control" id="nextItem" name="nextItem" style="text-align: right;">Next Item</button>
                </div>

            </div>
            <br />
        </div>
    </form>
    <br>
    <br>
    <form action="Stock_Input.php" method="post">
        <div class="row">
            <div class="col-lg-4">
                <button class="btn btn-info btn-sm form-control" id="search" name="search" style="border-radius: 10px;">Search</button>
            </div>
            <div class="col-lg-4">
                <button class="btn btn-info btn-sm form-control" id="open" name="open" style="border-radius: 10px;">Open</button>

            </div>
        </div>
    </form>

    	 
	<?php 
	
	 }
	 
	  elseif(isset($_POST['update']))
	 {
		
	
		 	$stockCode = $_POST['stockCode'];
            $date = $_POST['date'];
            $transactionType = $_POST['transactionType'];
            $documentNumber = $_POST['documentNumber'];
            $quantity = $_POST['quantity'];
            $unitCost = $_POST['unitCost'];
            $unitSell = $_POST['unitSell'];
		  	$description = $_POST['description'];
		 
		 	$update = "UPDATE `Stock` SET `date` = '$date', transactionType='$transactionType', documentNumber='$documentNumber', quantity='$quantity', unitCost='$unitCost', unitSell='$unitSell', description='$description' WHERE stockCode='$stockCode'";
		 	$conn->query($update);
		  if($conn->query($update)===TRUE)
		  {
		 	echo "Record adited and saved successfully";
			  echo "<br>";
		  }
		  else
		  {
			  echo "Ooops!".$conn->error;
		  		echo "<br>";
		  }
		 
	 }
	 
	 elseif(isset($_POST['invoiceDetail']))
			{
				header("Location: InvoiceDetail.php");
			}
	 
	 elseif(isset($_POST['stockMaster']))
			{
				header("Location: StockMaster.php");
			}
	 
	 elseif(isset($_POST['debtorsTransaction']))
			{
				header("Location: DebtorsTransaction.php");
			}
	 
	 elseif(isset($_POST['debtorsMaster']))
			{
				header("Location: DebtorsMaster.php");
			}
	 
$conn->close();
 
?>
	 
<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</body>
</html>