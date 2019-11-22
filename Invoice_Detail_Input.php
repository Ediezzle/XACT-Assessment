 <html>

 <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="xact.css" rel="stylesheet" type="text/css" />
    <title>Invoice Detail</title>
 </head>

 <body>

     <?php
        //$subtotal=200;
        include_once 'connections.php';
        if (isset($_POST['save'])) {
			
            $date = $_POST['date'];
            //$invoiceNumber = $_POST['invoiceNumber'];
            $accCode = $_POST['accCode'];
            $name = $_POST['name'];
            $itemNumber = $_POST['itemNumber'];
            $stockCode = $_POST['stockCode'];
            $quantitySold = $_POST['quantitySold'];
            //$unitCost = $_POST['unitCost'];
            //$unitSell = $_POST['unitSell'];
            $discount = $_POST['discount'];
            //$subTotal = $quantitySold * $unitSell - $discount;
			
			$retq = "SELECT * FROM Stock WHERE stockCode='$stockCode'";
			$res=$conn->query($retq);
			//$resString = serialize($res) ;
			//$resInt = (int)$resString;
			//echo $resInt;
			foreach($res as $rows)
			{	
				$unitCostInt = (double) $rows['unitCost'];
				$unitSellInt = (double) $rows['unitSell'];
	
			}

			$subTotal = $quantitySold * $unitSellInt - $discount;
			
			$insertq = "INSERT INTO InvoiceDetail (date, accCode, name, itemNumber, stockCode, quantitySold, unitCost, unitSell, discount, subtotal) VALUES('$date','$accCode', '$name', '$itemNumber', '$stockCode', '$quantitySold', '$unitCostInt', '$unitSellInt', '$discount', '$subTotal')";
			$result = $conn->query($insertq);
			
			//Reduce stock items by the number of items sold. Assumption is we can't sell something we don't have in stock so quantity will never be negative in Stock table.
			
			$deleteStockItem = "UPDATE `Stock` SET `quantity` = Stock.quantity-$quantitySold WHERE `Stock`.`stockCode` = '$stockCode'";
			
		 	$conn->query($deleteStockItem);

            $retrieveLastRecord = "SELECT * FROM InvoiceDetail ORDER BY invoiceNumber DESC LIMIT 1";
            $lastRecord = $conn->query($retrieveLastRecord);
			
			
			
			$updateStockMaster = "UPDATE StockMaster SET quantitySold=StockMaster.quantitySold+$quantitySold where stockCode='$stockCode'"; 
			$res=$conn->query($updateStockMaster);
			
			
			foreach ($lastRecord as $row) 
				{
					$invoiceNumber = $row['invoiceNumber'];
					$unCost = $row['unitCost'];
					$unSell = $row['unitSell'];
				}
			
			if($result===TRUE)
			{
				echo "The following record has been added successfully";
            ?> <form action="Invoice_Detail_Input.php" method="post">
        <div class="container-fluid bg-info">
            <h3 class="pageCenter"> Invoice Detail</h3>
            <br>
            <div class="row">
                <div class="col-lg-2"> Date</div>
                <div class="col-lg-1"> Invoice Number</div>
                <div class="col-lg-1"> Account Code</div>
                <div class="col-lg-1"> Name & Surname</div>
                <div class="col-lg-1"> Item Number</div>
                <div class="col-lg-1"> Stock Code</div>
                <div class="col-lg-1"> Quantity Sold</div>
                <div class="col-lg-1"> Unit Cost</div>
                <div class="col-lg-1"> Unit Sell</div>
                <div class="col-lg-1 "> Discount</div>
				<div class="col-lg-1 "> Sub Total</div>

            </div>
            <div class="row">
                <div class="col-lg-2"><input type="date" name="date" id="date" class="form-control" required value="<?php echo $date;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="invoiceNumber" id="invoiceNumber" class="form-control" readonly value="<?php echo $invoiceNumber;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="accCode" id="accCode" class="form-control" required value="<?php echo $row['accCode'];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="name" id="name" class="form-control" required value="<?php echo $name;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="itemNumber" id="itemNumber" class="form-control" required value="<?php echo $itemNumber;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="stockCode" id="stockCode" class="form-control" required value="<?php echo $stockCode;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="quantitySold" id="quantitySold" class="form-control" required value="<?php echo $quantitySold;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="unitCost" id="unCost" class="form-control" disabled value="<?php echo $unitCostInt;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="unitSell" id="unitSell" class="form-control" disabled value="<?php echo $unitSellInt;?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="discount" id="discount" class="form-control" required value="<?php echo $discount;?>"/>
                </div>
				<div class="col-lg-1"><input type="text" name="subTotal" id="subTotal" class="form-control" required value="<?php echo $subTotal;?>"/>
                </div>

            </div>
            <br />

            <div class="row">
                <div class="col-lg-4">
                    
                </div>
                <div class=" col-lg-4">
                    <a href="InvoiceDetail.php"><button class="btn btn-info btn-sm form-control" id="btic" name="btic">Back To Invoice Creation</button></a>
                </div>

                <div class="col-lg-4">
                    
                </div>

            </div>
            <br />
        </div>
    </form>
    <br>
    <br>
    <form action="Invoice_Detail_Input.php" method="post">
        <div class="row">
            <div class="col-lg-3">
                <button class="btn btn-info btn-sm form-control" id="search" name="search">Search</button>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-info btn-sm form-control" id="open" name="open">Open</button>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-info btn-sm form-control" id="delete" name="delete">Delete</button>
            </div>
        </div>
    </form>

	 <?php
			}
			
			else{
				echo "Ooops! ".$conn->error;
			}
		
			
			
			
			
			/*
			
			$insertq = "INSERT INTO InvoiceDetail (date, accCode, name, itemNumber, stockCode, quantitySold, unitCost, unitSell, discount, subtotal) VALUES('$date','$accCode', '$name', '$itemNumber', '$stockCode', '$quantitySold', '$unitCost', '$unitSell', '$discount', '$subTotal')";
			$deleteq = "DELETE FROM Stock WHERE stock.stockCode = '$stockCode'";  
				$conn->query($deleteq);
			$result = $conn->query($insertq);

            $retrieveLastRecord = "SELECT * FROM InvoiceDetail ORDER BY invoiceNumber DESC LIMIT 1";
            $lastRecord = $conn->query($retrieveLastRecord);

            //$res = $conn->query($retrieveq);
            if ($result === TRUE) {
                echo "<p>Record(s) have been saved successfully!</p>";

                echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Date</th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th>Sub Total</th>";


                echo "<tr>";
                echo "<td>" . $date . "</td>";
                echo "<td>";
                foreach ($lastRecord as $row) {
                    echo $row['invoiceNumber'];
                }
                echo "</td>";
                echo "<td>" . $accCode . "</td>";
                echo "<td>" . $name . "</td>";
                echo "<td>" . $itemNumber . "</td>";
                echo "<td>" . $stockCode . "</td>";
                echo "<td>" . $quantitySold . "</td>";
                echo "<td>" . $unitCost . "</td>";
                echo "<td>" . $unitSell . "</td>";
                echo "<td>" . $discount . "</td>";
                echo "<td>" . $subTotal . "</td>";
                echo "</tr>";
                echo " </table>";
				//$deleteq = "DELETE FROM Stock WHERE stock.stockCode = $stockCode";  
				//$conn->query($deleteq);
            } 
			
			else {
                echo "Error adding record(s)!: " . $conn->error;
            }
            echo "<br>";
			
			*/
        } 
	 
	 elseif(isset($_POST['btic']))
			{
				header("Location: InvoiceDetail.php");
			}
	 
	 elseif (isset($_POST['nextItem'])) {
            $date = $_POST['date'];
            //$invoiceNumber = $_POST['invoiceNumber'];
            $accCode = $_POST['accCode'];
            $name = $_POST['name'];
            $itemNumber = $_POST['itemNumber'];
            $stockCode = $_POST['stockCode'];
            $quantitySold = $_POST['quantitySold'];
            $unitCost = $_POST['unitCost'];
            $unitSell = $_POST['unitSell'];
            $discount = $_POST['discount'];
            $subTotal = $quantitySold * $unitSell - $discount;

            $insertq = "INSERT INTO InvoiceDetail (date, accCode, name, itemNumber, stockCode, quantitySold, unitCost, unitSell, discount, subtotal) VALUES('$date','$accCode', '$name', '$itemNumber', '$stockCode', '$quantitySold', '$unitCost', '$unitSell', '$discount', '$subTotal')";
            $result = $conn->query($insertq);
        } elseif (isset($_POST['search'])) {
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
            } elseif (isset($_POST['find'])) {
                $st = $_POST['searchTerm'];
                $searchq = " SELECT DISTINCT * FROM InvoiceDetail
    WHERE date LIKE '%$st%' 
     OR invoiceNumber LIKE '%$st%'
    OR accCode LIKE '%$st%'
    OR name LIKE '%$st%'
    OR itemNumber LIKE '%$st%'
    OR stockCode LIKE '%$st%'
    OR quantitySold LIKE '%$st%'
    OR unitCost LIKE '%$st%'
    OR unitSell LIKE '%$st%'
    OR discount LIKE '%$st%'
    OR subTotal LIKE '%$st%'
    LIMIT 0 , 30";
                $result = $conn->query($searchq);

                echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Date</th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th>Sub Total</th>
					</tr>";
                foreach ($result  as $row) {


                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['accCode'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['itemNumber'] . "</td>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['quantitySold'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
                    echo "<td>" . $row['discount'] . "</td>";
                    echo "<td>" . $row['subTotal'] . "</td>";
                    echo "</tr>";
                }
                echo " </table>";
            } elseif (isset($_POST['open'])) {
                $retrieveq = "SELECT * FROM InvoiceDetail";
                $result = $conn->query($retrieveq);
                echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Date</th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th>Sub Total</th>
                        <th>Edit</th>
                        <th>Delete</th>
					</tr>";
					
                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['accCode'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['itemNumber'] . "</td>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['quantitySold'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
                    echo "<td>" . $row['discount'] . "</td>";
                    echo "<td>" . $row['subTotal'] . "</td>";
                    echo "<td><b><a href='Invoice_Detail_Input.php?invoiceId={$row['invoiceNumber']}'>Edit</a></b></td>";
             		echo "<td><b><a href='Invoice_Detail_Input.php?id={$row['invoiceNumber']}'>Delete</a></b></td>";

					
        echo "</tr>";
   }
   echo " </table>";
 } 
	 elseif (isset($_GET['id'])) {
$id = $_REQUEST['id'];
  $retrieveq = "SELECT * FROM InvoiceDetail WHERE invoiceNumber=$id";
 $result = $conn->query($retrieveq);
			
			echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Date</th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th>Sub Total</th>
                        
                        <th>Delete</th>
					</tr>";

                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['accCode'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['itemNumber'] . "</td>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['quantitySold'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
                    echo "<td>" . $row['discount'] . "</td>";
                    echo "<td>" . $row['subTotal'] . "</td>";
             		echo "<td><b><a href='Invoice_Detail_Input.php?del={$row['invoiceNumber']}'>Confirm</a></b></td>";
        echo "</tr>";
   }
		 
   echo " </table>";
 }
	 
	 elseif (isset($_GET['del'])) {
                        $del = $_GET['del'];
                        //SQL query for deletion.
                        $deleteq = "DELETE FROM InvoiceDetail WHERE invoiceNumber=$del";
                        $result = $conn->query($deleteq);
		 				echo "Record successfully deleted!";
                    }
	 
	 elseif(isset($_GET['invoiceId']))
	 {
		 $id = $_REQUEST['invoiceId'];
  $retrieveq = "SELECT * FROM InvoiceDetail WHERE invoiceNumber=$id";
 $result = $conn->query($retrieveq);
			
			echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Date</th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th>Sub Total</th>
                        
                        <th>Edit</th>
					</tr>";

                foreach ($result as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['accCode'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['itemNumber'] . "</td>";
                    echo "<td>" . $row['stockCode'] . "</td>";
                    echo "<td>" . $row['quantitySold'] . "</td>";
                    echo "<td>" . $row['unitCost'] . "</td>";
                    echo "<td>" . $row['unitSell'] . "</td>";
                    echo "<td>" . $row['discount'] . "</td>";
                    echo "<td>" . $row['subTotal'] . "</td>";
             		echo "<td><b><a href='Invoice_Detail_Input.php?ed={$row['invoiceNumber']}'>Confirm</a></b></td>";
        		echo "</tr>";
   }
		 
   echo " </table>";
	 }
	 
	 elseif(isset($_GET['ed']))
	 {
		 $id = $_GET['ed'];
		 $retrieveq = "SELECT * FROM InvoiceDetail WHERE invoiceNumber=$id";
 		 $result = $conn->query($retrieveq);
		 //$row = (array)$result;
	$row = $result->fetch_array();
		 $invNum = $row[1];
		?> <form action="Invoice_Detail_Input.php" method="post">
        <div class="container-fluid bg-info">
            <h3 class="pageCenter"> Invoice Detail</h3>
            <br>
            <div class="row">
                <div class="col-lg-2"> Date</div>
                <div class="col-lg-1"> Invoice Number</div>
                <div class="col-lg-1"> Account Code</div>
                <div class="col-lg-2"> Name & Surname</div>
                <div class="col-lg-1"> Item Number</div>
                <div class="col-lg-1"> Stock Code</div>
                <div class="col-lg-1"> Quantity Sold</div>
                <div class="col-lg-1"> Unit Cost</div>
                <div class="col-lg-1"> Unit Sell</div>
                <div class="col-lg-1 "> Discount</div>

            </div>
            <div class="row">
                <div class="col-lg-2"><input type="date" name="date" id="date" class="form-control" required value="<?php echo $row[0];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="invoiceNumber" id="invoiceNumber" class="form-control" readonly value="<?php echo $row[1];?>">
                </div>
                <div class="col-lg-1"><input type="text" name="accCode" id="accCode" class="form-control" required value="<?php echo $row[2];?>"/>
                </div>
                <div class="col-lg-2"><input type="text" name="name" id="name" class="form-control" required value="<?php echo $row[3];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="itemNumber" id="itemNumber" class="form-control" required value="<?php echo $row[4];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="stockCode" id="stockCode" class="form-control" required value="<?php echo $row[5];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="quantitySold" id="quantitySold" class="form-control" required value="<?php echo $row[6];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="unitCost" id="unitCost" class="form-control" required value="<?php echo $row[7];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="unitSell" id="unitSell" class="form-control" required value="<?php echo $row[8];?>"/>
                </div>
                <div class="col-lg-1"><input type="text" name="discount" id="discount" class="form-control" required value="<?php echo $row[9];?>"/>
                </div>

            </div>
            <br />

            <div class="row">
                <div class="col-lg-4">
                    
                </div>
                <div class=" col-lg-4">
                    <button class="btn btn-info btn-sm form-control" id="update" name="update">Update</button>
                </div>

                <div class="col-lg-4">
                    
                </div>

            </div>
            <br />
        </div>
    </form>
    <br>
    <br>
    <form action="Invoice_Detail_Input.php" method="post">
        <div class="row">
            <div class="col-lg-3">
                <button class="btn btn-info btn-sm form-control" id="search" name="search">Search</button>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-info btn-sm form-control" id="open" name="open">Open</button>
            </div>
            <div class="col-lg-3">
                <button class="btn btn-info btn-sm form-control" id="delete" name="delete">Delete</button>
            </div>
        </div>
    </form>


	<?php 
	 }
	 
	 elseif(isset($_POST['update']))
	 {
		
	
		 	$date = $_POST['date'];
            $invoiceNumber = $_POST['invoiceNumber'];
            $accCode = $_POST['accCode'];
            $name = $_POST['name'];
            $itemNumber = $_POST['itemNumber'];
            $stockCode = $_POST['stockCode'];
            $quantitySold = $_POST['quantitySold'];
            $unitCost = $_POST['unitCost'];
            $unitSell = $_POST['unitSell'];
            $discount = $_POST['discount'];
            $subTotal = $quantitySold * $unitSell - $discount;
		 
		 	$update = "UPDATE `InvoiceDetail` SET `accCode` = '$accCode',
			`name` = '$name', itemNumber='$itemNumber', stockCode='$stockCode', quantitySold='$quantitySold', unitCost='$unitCost', unitSell='$unitSell', discount='$discount', subTotal='$subTotal' WHERE invoiceNumber='$invoiceNumber'";
		 	$conn->query($update);
		 	echo "Record adited and saved successfully";
		 
	 }
	 
$conn->close();
 
?>
	 
	 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	 <script src="bootstrap/js/jquery.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>

 </body>

 </html>