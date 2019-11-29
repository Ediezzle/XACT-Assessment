 <html>

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initialscale=1.0">
     <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
     <link href="xact.css" rel="stylesheet" type="text/css" />
     <title>Invoice Details</title>
 </head>

 <body>

     <?php
        //including the file in which i establiched a connection with the database
        include_once 'connections.php';

        //checking if save button has been clicked
        if (isset($_POST['save'])) {
            //assigning variables to user entered values
            $date = $_POST['date'];
            $accCode = $_POST['accCode'];
            $name = $_POST['name'];
            $itemNumber = $_POST['itemNumber'];
            $stockCode = $_POST['stockCode'];
            $quantitySold = $_POST['quantitySold'];
            $discount = $_POST['discount'];
            $transactionType = $_POST['transactionType'];

            //fetching specific entries from the database
            $retq = "SELECT * FROM Stock WHERE stockCode='$stockCode'";
            $res = $conn->query($retq);

            //casting some retrieved string values to doubles
            foreach ($res as $rows) {
                $unitCostDouble = (double) $rows['unitCost'];
                $unitSellDouble = (double) $rows['unitSell'];
            }

            $subTotal = (double) ((int) $quantitySold * $unitSellDouble - $discount);

            //capturing values into the database
            $insertq = "INSERT INTO InvoiceDetail (date, accCode, name, itemNumber, stockCode, quantitySold, unitCost, unitSell, discount, subtotal, transactionType) VALUES('$date','$accCode', '$name', '$itemNumber', '$stockCode', '$quantitySold', '$unitCostDouble', '$unitSellDouble', '$discount', '$subTotal', '$transactionType')";
            $result = $conn->query($insertq);


            //fetching credit sales transactions
            $retrieveq = "SELECT * FROM InvoiceDetail WHERE transactionType='Credit'";
            $retResult = $conn->query($retrieveq);

            //variable assignment
            foreach ($retResult as $retRow) {
                $d = $retRow['date'];
                $nm = $retRow['name'];
                $ac = $retRow['accCode'];
                $tt = $retRow['transactionType'];
                $in = $retRow['invoiceNumber'];
                $gtv = $retRow['subTotal'];
                $vv = 0.15 * $gtv;
                $quantitySoldCredit = $retRow['quantitySold'];
                $unitCostCredit = $retRow['unitCost'];
                $unitSellCredit = $retRow['unitSell'];
                $tT = $retRow['transactionType'];
            }

            //Creating entries into the DebtorsTransaction table whenever a credit sale occurs			
            $insertInDebtorsTransaction = "INSERT INTO DebtorsTransaction VALUES ('$d', '$nm', '$ac', '$tt', '$in', '$gtv', '$vv')";
            $insertDebtorsTransactionResult = $conn->query($insertInDebtorsTransaction);


            //Reduce stock items by the number of items sold. Assumption is we can't sell something we don't have in stock so quantity will never be negative in Stock table.

            $deleteStockItem = "UPDATE `Stock` SET `quantity` = Stock.quantity-$quantitySold WHERE `Stock`.`stockCode` = '$stockCode'";

            $conn->query($deleteStockItem);

            $retrieveLastRecord = "SELECT * FROM InvoiceDetail ORDER BY invoiceNumber DESC LIMIT 1";
            $lastRecord = $conn->query($retrieveLastRecord);
            $tsev = (float) ((int) $quantitySold * $unitSellDouble * 0.85);

            //Incrementing quantity sold in the StockMaster table everytime an item is sold
            $updateStockMaster = "UPDATE StockMaster SET quantitySold=StockMaster.quantitySold+$quantitySold, tsev=tsev+$tsev where stockCode='$stockCode'";
            $res = $conn->query($updateStockMaster);
			
			//displaying different messages in accordance with the results of the executed queries
            if ($insertDebtorsTransactionResult === TRUE) {
                echo "Transaction recorded in Debtors Transaction File";
                echo "<br>";
            }

            if (isset($_POST['credit']) && !$insertDebtorsTransactionResult === TRUE)
                echo "Ooops" . $conn->error;

            if ($res === TRUE) {
                echo "Quantity sold successfully updated in StockMaster";
                echo "<br>";
            } else {
                echo "Ooops! " . $conn->error;
                echo "<br>";
            }


            foreach ($lastRecord as $row) {
                $invoiceNumber = $row['invoiceNumber'];
                $unCost = $row['unitCost'];
                $unSell = $row['unitSell'];
                $transType = $row['transactionType'];
            }

            $fetchq = "SELECT * FROM DebtorsMaster";
            $fetchRes = $conn->query($fetchq);
            foreach ($fetchRes as $fetchedRow) {
                $costYearToDate = $quantitySoldCredit * $unitCostCredit;
                $salesYearToDate = $quantitySoldCredit * $unitSellCredit;
                $paid = $fetchedRow['paid'];
                $balance = $fetchedRow['salesYearToDate'] - $paid;
            }

			//updating the debtors master table with credit sale transactions
            if ($tT = 'credit') {
                $updateDebtorsMaster = "INSERT INTO DebtorsMaster (accCode, name, costYearToDate, salesYearToDate, paid, balance) VALUES ('$ac', '$nm', '$costYearToDate', '$salesYearToDate', '$paid', '$balance') ON DUPLICATE KEY UPDATE name='$nm', costYearToDate=costYearToDate+'$costYearToDate', salesYearToDate=salesYearToDate+'$salesYearToDate', paid='$paid', balance=salesYearToDate-'$paid'";
                $updateResult = $conn->query($updateDebtorsMaster);
            }

            if ($updateResult === TRUE) {
                echo "Debtors Master successfully updated";
                echo "<br>";
            }

            if ($transType = 'credit' && !$updateResult === TRUE) {
                echo "Ooops!" . $conn->error;
                echo "<br>";
            }

            if ($result === TRUE) {
                //displaying the successfully saved record
                echo "The following record has been added successfully";
                ?> <form action="Invoice_Detail_Input.php" method="post">
                 <div class="container-fluid bg-info">
                     <h3 class="pageCenter"> Invoice Details</h3>
                     <br>
                     <div class="row" style="text-align: center;">
                         <div class="col-lg-2"> Date</div>
                         <div class="col-lg-2"> Invoice Number</div>
                         <div class="col-lg-2"> Transaction Type</div>
                         <div class="col-lg-2"> Account Code</div>
                         <div class="col-lg-2"> Name & Surname</div>
                         <div class="col-lg-2"> Item Number</div>
                      </div>
                     <div class="row">
                         <div class="col-lg-2"><input type="date" name="date" id="date" class="form-control" readonly value="<?php echo $date; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="invoiceNumber" id="invoiceNumber" class="form-control" readonly value="<?php echo $invoiceNumber; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="transactionType" id="transactionType" class="form-control" readonly value="<?php echo $transactionType; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="accCode" id="accCode" class="form-control" readonly value="<?php echo $row['accCode']; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="name" id="name" class="form-control" readonly value="<?php echo $name; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="itemNumber" id="itemNumber" class="form-control" readonly value="<?php echo $itemNumber; ?>" />
                         </div>
                      </div>
					 
					 <br>
					 <div class="row">
					  <div class="col-lg-2"> Stock Code</div>
                         <div class="col-lg-2"> Quantity Sold</div>
                         <div class="col-lg-2"> Unit Cost</div>
                         <div class="col-lg-2"> Unit Sell</div>
                         <div class="col-lg-2 "> Discount</div>
                         <div class="col-lg-2 "> Sub Total</div>
					   </div>
					 <div class="row">
					 <div class="col-lg-2"><input type="text" name="stockCode" id="stockCode" class="form-control" readonly value="<?php echo $stockCode; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="quantitySold" id="quantitySold" class="form-control" readonly value="<?php echo $quantitySold; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="unitCost" id="unCost" class="form-control" disabled value="<?php echo $unitCostDouble; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="unitSell" id="unitSell" class="form-control" disabled value="<?php echo $unitSellDouble; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="discount" id="discount" class="form-control" readonly value="<?php echo $discount; ?>" />
                         </div>
                         <div class="col-lg-2"><input type="text" name="subTotal" id="subTotal" class="form-control" readonly value="<?php echo $subTotal; ?>" />
                         </div>
						 </div>
                     <br/>

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

         <?php
                } else {
                    echo "Ooops! " . $conn->error;
                }
            }

            //methods to redirect to respective locations
            elseif (isset($_POST['btic'])) {
                header("Location: InvoiceDetail.php");
            } elseif (isset($_POST['stock'])) {
                header("Location: Stock.php");
            } elseif (isset($_POST['stockMaster'])) {
                header("Location: StockMaster.php");
            } elseif (isset($_POST['debtorsTransaction'])) {
                header("Location: DebtorsTransaction.php");
            } elseif (isset($_POST['debtorsMaster'])) {
                header("Location: DebtorsMaster.php");
            }

            //checking if search has been clicked and implementing the search algorithm
            elseif (isset($_POST['search'])) {
                ?>
         <form method='POST' action="<?php echo $_SERVER['PHP_SELF'];  ?>">
             <br />
             <br />
             <h3 class="pageCenter"> Invoice Details</h3>
             <br>
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
	OR transactionType LIKE '%$st%'";
            $result = $conn->query($searchq);
            echo "<h3 class='pageCenter'> Invoice Details</h3>
                     <br>";
            echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Date</th>
                        <th>Invoice Number</th>
						<th>Transaction Type</th>
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
                echo "<td>" . $row['transactionType'] . "</td>";
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

            //opening all records if open button has been clicked
        } elseif (isset($_POST['open'])) {
            $retrieveq = "SELECT * FROM InvoiceDetail";
            $result = $conn->query($retrieveq);
            echo "<form method='post' action=Invoice_Detail_Input.php>";
            echo "<h3 class='pageCenter'> Invoice Details</h3>
                     <br>";
            echo "<table class = 'table table-striped'>
                    <tr>
                        <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Invoice Number</th>
						<th>Transaction Type</th>
                        <th>Account Code</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th><button name='ascendingSubTotal' id='ascendingSubTotal'><img src='ascending.PNG' width='10' height='15' alt='ascendingSubTotal'/></button>Sub Total<button name='descendingSubTotal' id='descendingSubTotal'><img src='descending.PNG' width='10' height='15' alt='descendingSubTotal'/></button></th>
						
 					</tr>";

            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['invoiceNumber'] . "</td>";
                echo "<td>" . $row['transactionType'] . "</td>";
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
            echo "</form>";
            echo "<h4 class='pageCenter'><strong>TOTALS</strong><h4>";
            echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th>Grand Total</th>
 					</tr>";

            $fetchQuantitySoldTotal = "SELECT SUM(quantitySold) qs FROM InvoiceDetail ";
            $executeFetchQuantitySoldTotal = $conn->query($fetchQuantitySoldTotal);
            foreach ($executeFetchQuantitySoldTotal as $r) {
                $stringQuantitySoldTotal = $r['qs'];
            }

            $fetchSubTotalSum = "SELECT SUM(subTotal) sbt FROM InvoiceDetail ";
            $executeFetchSubTotalSum = $conn->query($fetchSubTotalSum);
            foreach ($executeFetchSubTotalSum as $subRow) {
                $stringSubTotalSum = $subRow['sbt'];
            }

            $fetchUnitCostTotal = "SELECT SUM(unitCost) uct FROM InvoiceDetail ";
            $executeFetchUnitCostTotal = $conn->query($fetchUnitCostTotal);
            foreach ($executeFetchUnitCostTotal  as $unitCostTotalRow) {
                $stringUnitCostTotal = $unitCostTotalRow['uct'];
            }

            $fetchUnitSellTotal = "SELECT SUM(unitSell) usl FROM InvoiceDetail ";
            $executeFetchUnitSellTotal = $conn->query($fetchUnitSellTotal);
            foreach ($executeFetchUnitSellTotal  as $unitSellTotalRow) {
                $stringUnitSellTotal = $unitSellTotalRow['usl'];
            }

            $fetchDiscountTotal = "SELECT SUM(discount) d FROM InvoiceDetail ";
            $executeFetchDiscountTotal = $conn->query($fetchDiscountTotal);
            foreach ($executeFetchDiscountTotal  as $discountTotalRow) {
                $stringDiscountTotal = $discountTotalRow['d'];
            }

            echo "<tr>";
            echo "<td>" . $stringQuantitySoldTotal . "</td>";
            echo "<td>" .  $stringUnitCostTotal . "</td>";
            echo "<td>" .  $stringUnitSellTotal . "</td>";
            echo "<td>" . $stringDiscountTotal . "</td>";
            echo "<td>" . $stringSubTotalSum . "</td>";
            echo "</tr>";
            echo " </table>";
        }
        //sorting by date in descending order
        elseif (isset($_POST['descending'])) {
            $retrieveq = "SELECT * FROM InvoiceDetail ORDER BY date DESC";
            $result = $conn->query($retrieveq);
            echo "<form method='post' action=Invoice_detail_Input.php>";
            echo "<h3 class='pageCenter'> Invoice Details</h3>
                     <br>";
            echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th><button name='ascendingSubTotal' id='ascendingSubTotal'><img src='ascending.PNG' width='10' height='15' alt='ascendingSubTotal'/></button>Sub Total<button name='descendingSubTotal' id='descendingSubTotal'><img src='descending.PNG' width='10' height='15' alt='descendingSubTotal'/></button></th>
						
 					</tr>";

            if (is_array($result) || is_object($result)) {
                foreach ($result as $row) {

                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
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
            }
            echo " </table>";
            echo "</form>";
        }

        //sorting by date in ascending order
        elseif (isset($_POST['ascending'])) {
            $retrieveq = "SELECT * FROM InvoiceDetail ORDER BY date ASC";
            $result = $conn->query($retrieveq);
            echo "<form method='post' action='Invoice_Detail_Input.php'>";
            echo "<h3 class='pageCenter'> Invoice Details</h3>
                     <br>";
            echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th><button name='ascendingSubTotal' id='ascendingSubTotal'><img src='ascending.PNG' width='10' height='15' alt='ascendingSubTotal'/></button>Sub Total<button name='descendingSubTotal' id='descendingSubTotal'><img src='descending.PNG' width='10' height='15' alt='descendingSubTotal'/></button></th>
 					</tr>";

            if (is_array($result) || is_object($result)) {
                foreach ($result as $row) {

                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
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
            }
            echo " </table>";
            echo "</form>";
        }
	 
        //sorting by sub total in descending order
        elseif (isset($_POST['ascendingSubTotal'])) {
            $retrieveq = "SELECT * FROM InvoiceDetail ORDER BY subTotal ASC";
            $result = $conn->query($retrieveq);
            echo "<form method='post' action='Invoice_Detail_Input.php'>";
            echo "<h3 class='pageCenter'> Invoice Details</h3>
                     <br>";
            echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th><button name='ascendingSubTotal' id='ascendingSubTotal'><img src='ascending.PNG' width='10' height='15' alt='ascendingSubTotal'/></button>Sub Total<button name='descendingSubTotal' id='descendingSubTotal'><img src='descending.PNG' width='10' height='15' alt='descendingSubTotal'/></button></th>
						
 					</tr>";

            if (is_array($result) || is_object($result)) {
                foreach ($result as $row) {

                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
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
            }
            echo " </table>";
            echo "</form>";
        }
	 
        //sorting by sub total in descending order
        elseif (isset($_POST['descendingSubTotal'])) {
            $retrieveq = "SELECT * FROM InvoiceDetail ORDER BY subTotal DESC";
            $result = $conn->query($retrieveq);
            echo "<form method='post' action='Invoice_Detail_Input.php'>";
            echo "<h3 class='pageCenter'> Invoice Details</h3>
                     <br>";
            echo "<table class = 'table table-striped'>
                    <th><button name='ascending' id='ascending'><img src='ascending.PNG' width='10' height='15' alt='ascending'/></button>Date<button name='descending' id='descending'><img src='descending.PNG' width='10' height='15' alt='descending'/></button></th>
                        <th>Invoice Number</th>
                        <th>Account Code</th>
						<th>Transaction Type</th>
                        <th>Name & Surname</th>
                        <th>Item Number</th>
                        <th>Stock Code</th>
                        <th>Quantity Sold</th>
                        <th>Unit Cost</th>
                        <th>Unit Sell</th>
                        <th>Discount</th>
                        <th><button name='ascendingSubTotal' id='ascendingSubTotal'><img src='ascending.PNG' width='10' height='15' alt='ascendingSubTotal'/></button>Sub Total<button name='descendingSubTotal' id='descendingSubTotal'><img src='descending.PNG' width='10' height='15' alt='descendingSubTotal'/></button></th>
 					</tr>";

            if (is_array($result) || is_object($result)) {
                foreach ($result as $row) {

                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['invoiceNumber'] . "</td>";
                    echo "<td>" . $row['transactionType'] . "</td>";
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
            }
            echo " </table>";
            echo "</form>";
        }

        //terminating connection to the database	 
        $conn->close();
        ?>

     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
     <script src="bootstrap/js/jquery.js" type="text/javascript"></script>
     <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>

 </body>

 </html>