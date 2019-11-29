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

	<?php
	
	//establishing a once-off connection to the database
	include_once('connections.php');
	
	//fetching all records with the chosen id from the DebtorsMaster table and displaying them
	if (isset($_GET['id'])) {
		$id = $_REQUEST['id'];
		$retrieveq = "SELECT * FROM DebtorsMaster WHERE accCode='$id'";
		$result = $conn->query($retrieveq);
		echo "<h3 class='pageCenter'> <b>Debtors Master</b></h3>
		<br>";
		echo "<table class = 'table table-striped'>
	                    <tr>
                        <th>Account Code</th>
                        <th>Name</th>
                        <th name='address1'>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Cost Year To Date</th>
						<th>Sales Year To Date</th>
                        <th>Paid</th>
						<th>Balance</th>						<th>Delete</th>
					 </tr>";

		foreach ($result as $row) {
			$balance = $row['salesYearToDate'] - $row['paid'];
			echo "<tr>";
			echo "<td>" . $row['accCode'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['address1'] . "</td>";
			echo "<td>" . $row['address2'] . "</td>";
			echo "<td>" . $row['address3'] . "</td>";
			echo "<td>" . $row['costYearToDate'] . "</td>";
			echo "<td>" . $row['salesYearToDate'] . "</td>";
			echo "<td>" . $row['paid'] . "</td>";
			echo "<td>" . $balance . "</td>";
			echo "<td><b><a href='Debtors_Master_Input.php?del={$row['accCode']}'>Confirm</a></b></td>";
			echo "</tr>";
		}
		echo " </table>";
	} 
	
	//implementing the delete functionality
	elseif (isset($_GET['del'])) {
		$del = $_GET['del'];

		$deleteq = "DELETE FROM DebtorsMaster WHERE accCode='$del'";
		$result = $conn->query($deleteq);
		if ($result === TRUE)
			echo "Entire record successfully deleted!";
		else
			echo "Ooops!" . $conn->error;
	} 
	
	//fetching results with the selected account code and displaying them
	elseif (isset($_GET['accCode'])) {
		$id = $_REQUEST['accCode'];
		$retrieveq = "SELECT * FROM DebtorsMaster WHERE accCode='$id'";
		$result = $conn->query($retrieveq);
		echo "<form method='POST' action='Stock_Master_Input.php'>";
		echo "<h3 class='pageCenter'> <b>Debtors Master</b></h3>
		<br>";
		echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Account Code</th>
                        <th>Name</th>
                        <th name='address1'>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Cost Year To Date</th>
						<th>Sales Year To Date</th>
                        <th>Paid</th>
						<th>Balance</th>
						<th>Edit</th>
					</tr>";

		foreach ($result as $row) {
			$balance = $row['salesYearToDate'] - $row['paid'];
			echo "<tr>";
			echo "<td>" . $row['accCode'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['address1'] . "</td>";
			echo "<td>" . $row['address2'] . "</td>";
			echo "<td>" . $row['address3'] . "</td>";
			echo "<td>" . $row['costYearToDate'] . "</td>";
			echo "<td>" . $row['salesYearToDate'] . "</td>";
			echo "<td>" . $row['paid'] . "</td>";
			echo "<td>" . $row['balance'] . "</td>";
			echo "<td><b><a href='Debtors_Master_Input.php?ed={$row['accCode']}'>Confirm</a></b></td>";
			echo "</tr>";
		}

		echo " </table>";
		echo " </form>";
	} 
	
	//populating the fields in need of editing and presenting them to the user
	elseif (isset($_GET['ed'])) {
		$id = $_GET['ed'];
		$retrieveq = "SELECT * FROM DebtorsMaster WHERE accCode='$id'";
		$result = $conn->query($retrieveq);
		
		//$row = (array)$result;
		$row = $result->fetch_array();

		?>

		<form action="Debtors_Master_Input.php" method="post">
			<div class="container-fluid bg-info">
				<h3 class="pageCenter"> Debtors Master Details</h3>
				<br>
				<div class="row">
					<div class="col-lg-1"> <strong>Account Code</strong></div>
					<div class="col-lg-2"> <strong>Name</div></strong>
					<div class="col-lg-1"> <strong>Address 1</strong></div>
					<div class="col-lg-1"> <strong>Address 2</strong></div>
					<div class="col-lg-1"> <strong>Address 3</strong></div>
					<div class="col-lg-1"> <strong>Cost Year To Date</strong></div>
					<div class="col-lg-1"> <strong>Sales Year To Date</strong></div>
					<div class="col-lg-1"> <strong>Paid</strong></div>
					<div class="col-lg-3"> <strong>Balance</strong></div>


				</div>
				<div class="row">
					<div class="col-lg-1"><input type="text" name="accCode" id="accCode" class="form-control" required value="<?php echo $row['0']; ?>" />
					</div>
					<div class="col-lg-2"><input type="name" name="name" id="name" class="form-control" required value="<?php echo $row[1]; ?>" />
					</div>
					<div class="col-lg-1"><input type="text" name="address1" id="address1" class="form-control" required value="<?php echo $row[3]; ?>" />
					</div>
					<div class="col-lg-1"><input type="text" name="address2" id="address2" class="form-control" value="<?php echo $row[3]; ?>" />
					</div>
					<div class="col-lg-1"><input type="text" name="address3" id="address3" class="form-control" value="<?php echo $row[4]; ?>" />
					</div>
					<div class="col-lg-1"><input type="text" name="costYearToDate" id="costYearToDate" class="form-control" required value="<?php echo $row[5]; ?>" />
					</div>
					<div class="col-lg-1"><input type="text" name="salesYearToDate" id="salesYearToDate" class="form-control" required value="<?php echo $row[6]; ?>" />
					</div>
					<div class="col-lg-1"><input type="text" name="paid" id="paid" class="form-control" required value="<?php echo $row[7]; ?>" />
					</div>
					<div class="col-lg-3"><input type="text" name="balance" id="balance" class="form-control" readonly value="<?php echo $row[8]; ?>" />
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-lg-5">
					</div>
					<div class="col-lg-2">
						<a href="InvoiceDetail.php"> <button class="btn btn-info btn-sm formcontrol" id="update" name="update">Update</button></a>
					</div>
					<div class="col-lg-5">
					</div>
				</div>
				<br />
			</div>
		</form>
		<br>
		<br>
		<form method="post" action='Debtors_Master_Input.php'>
			<div class="row">
				<div class=" col-lg-4">

				</div>
				<div class=" col-lg-4">
					<button class="btn btn-info btn-sm form-control" id="bmh" name="dmh" style="float: right; border-radius: 10px;">Back to Debtors Master Home</button>
				</div>
				<div class=" col-lg-4">

				</div>
			</div>
		</form>

	<?php

	} 
	
	//implementing update functionality
	elseif (isset($_POST['update'])) {


		$accCode = $_POST['accCode'];
		$name = $_POST['name'];
		$address1 = $_POST['address1'];
		$address2 = $_POST['address2'];
		$address3 = $_POST['address3'];
		$costYearToDate = $_POST['costYearToDate'];
		$salesYearToDate = $_POST['salesYearToDate'];
		$paid = $_POST['paid'];
		
		//updating the debtors master table. 
		$update = "UPDATE `DebtorsMaster` SET `accCode` = '$accCode', name='$name', address1='$address1', address2='$address2', address3='$address3', costYearToDate='$costYearToDate', paid = $paid, balance='$salesYearToDate'-'$paid' WHERE accCode='$accCode'";
		$conn->query($update);
		if ($conn->query($update) === TRUE) {
			echo "Record adited and saved successfully";
			echo "<br>";
		} else {
			echo "Ooops!" . $conn->error;
			echo "<br>";
		}
	}

	//implementing search algorithm
	elseif (isset($_POST['search'])) {
		?>
		<form method='POST' action="<?php echo $_SERVER['PHP_SELF'];  ?>">
			<br />
			<br />
			<h3 class='pageCenter'> <b>Debtors Master</b></h3>
			<br>
			<div class="row container">
				<div class="col-lg-2"> <input class="formcontrol" type="text" name="searchTerm" placeholder="Type in what you want to search for and Hit Find"> </div>
				<div class="col-lg-3"> <button class="btn btn-sm btn-info" type="submit" name="find"> Find</button> </div>
			</div>
		</form>
	<?php
	} 
	
	//fetching the search results from the database and presenting them to the user
	elseif (isset($_POST['find'])) {
		$st = $_POST['searchTerm'];
		$searchq = " SELECT DISTINCT * FROM DebtorsMaster
    WHERE accCode LIKE '%$st%' 
     OR name LIKE '%$st%'
    OR address1 LIKE '%$st%'
    OR address2 LIKE '%$st%'
    OR address3 LIKE '%$st%'
    OR costYearToDate LIKE '%$st%'
    OR salesYearToDate LIKE '%$st%'
    OR paid LIKE '%$st%'
    OR balance LIKE '%$st%'";
		$result = $conn->query($searchq);
		echo " <h3 class='pageCenter'> <b>Debtors Master</b></h3>
	<br>";
		echo "<table class = 'table table-striped'>
                    <tr>
                        <th>Account Code</th>
                        <th>Name</th>
                        <th name='address1'>Address 1</th>
                        <th>Address 2</th>
                        <th>Address 3</th>
                        <th>Cost Year To Date</th>
						<th>Sales Year To Date</th>
                        <th>Paid</th>
						<th>Balance</th>	
					</tr>";
		foreach ($result  as $row) {

			$balance = $row['salesYearToDate'] - $row['paid'];
			echo "<tr>";
			echo "<td>" . $row['accCode'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['address1'] . "</td>";
			echo "<td>" . $row['address2'] . "</td>";
			echo "<td>" . $row['address3'] . "</td>";
			echo "<td>" . $row['costYearToDate'] . "</td>";
			echo "<td>" . $row['salesYearToDate'] . "</td>";
			echo "<td>" . $row['paid'] . "</td>";
			echo "<td>" . $row['balance'] . "</td>";
			echo "</tr>";
		}
		echo " </table>";

		//sorting by date in descending order
	} elseif (isset($_POST['descendingSYTD'])) {
		$retrieveq = "SELECT * FROM DebtorsMaster ORDER BY salesYearToDate DESC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action=Debtors_Master_Input.php>";
		echo " <h3 class='pageCenter'> <b>Debtors Master</b></h3>
	<br>";
		echo "<table class = 'table table-striped'>
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

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				$balance = $row['costYearToDate'] - $row['paid'];
				echo "<tr>";
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
		}
		echo " </table>";
		echo "</form>";
	} 
	
	//sorting by sales year to date in ascending order
	elseif (isset($_POST['ascendingSYTD'])) {
		$retrieveq = "SELECT * FROM DebtorsMaster ORDER BY salesYearToDate ASC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action='Debtors_Master_Input.php'>";
		echo " <h3 class='pageCenter'> <b>Debtors Master</b></h3>
	<br>";
		echo "<table class = 'table table-striped'>
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

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				$balance = $row['costYearToDate'] - $row['paid'];
				echo "<tr>";
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
		}
		echo " </table>";
		echo "</form>";
	} 
	
	//sorting by balance in ascending order
	elseif (isset($_POST['ascendingBal'])) {
		$retrieveq = "SELECT * FROM DebtorsMaster ORDER BY balance ASC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action='Debtors_Master_Input.php'>";
		echo " <h3 class='pageCenter'> <b>Debtors Master</b></h3>
	<br>";
		echo "<table class = 'table table-striped'>
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

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {

				$balance = $row['costYearToDate'] - $row['paid'];
				echo "<tr>";
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
		}
		echo " </table>";
		echo "</form>";
	} 
	
	//sorting by balance in descending order
	elseif (isset($_POST['descendingBal'])) {
		$retrieveq = "SELECT * FROM DebtorsMaster ORDER BY balance DESC";
		$result = $conn->query($retrieveq);
		echo "<form method='post' action=Debtors_Master_Input.php>";
		echo " <h3 class='pageCenter'> <b>Debtors Master</b></h3>
	<br>";
		echo "<table class = 'table table-striped'>
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

		if (is_array($result) || is_object($result)) {
			foreach ($result as $row) {
				
				//calculating balance
				$balance = $row['costYearToDate'] - $row['paid'];
				echo "<tr>";
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
	} elseif (isset($_POST['dmh'])) {
		header("Location: DebtorsMaster.php");
	} elseif (isset($_POST['debtorsTransaction'])) {
		header("Location: DebtorsTransaction.php");
	}
	$conn->close();
	?>

	<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</body>

</html>