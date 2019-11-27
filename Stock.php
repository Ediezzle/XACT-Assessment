<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="xact.css" rel="stylesheet" type="text/css" />
    <title>Stock</title>
</head>

<body>

    <form action="Stock_Input.php" method="post">
        <div class="container-fluid bg-info">
            <h3 class="pageCenter"> Stock Details</h3>
            <br>
            <div class="row" style="text-align:center">
                <div class="col-lg-1"> <strong>Stock Code</strong></div>
                <div class="col-lg-2"> <strong>Date</div></strong>
                <div class="col-lg-1"> <strong>Transaction Type</strong></div>
                <div class="col-lg-1"> <strong>Document Number</strong></div>
                <div class="col-lg-1"> <strong>Quantity</strong></div>
                <div class="col-lg-1"> <strong>Unit Cost</strong></div>
                <div class="col-lg-1"> <strong>Unit Sell</strong></div>
				<div class="col-lg-4"> <strong>Description</strong></div>
                

            </div>
            <div class="row">
                <div class="col-lg-1"><input type="text" name="stockCode" id="stockCode" class="form-control" required />
                </div>
				<div class="col-lg-2"><input type="date" name="date" id="date" class="form-control" required />
                </div>
                <div class="col-lg-1">
					
						<label for="transLab"></label>
							<select class="form-control" id="transactionType" name="transactionType" style="margin-top: -29%;">
								<option>Cash</option>
								<option>Credit</option>
							</select>
					
                </div>
                <div class="col-lg-1"><input type="text" name="documentNumber" id="documentNumber" class="form-control" required />
                </div>
                
                <div class="col-lg-1"><input type="text" name="quantity" id="quantity" class="form-control" required />
                </div>
                <div class="col-lg-1"><input type="text" name="unitCost" id="unitCost" class="form-control" required />
                </div>
                <div class="col-lg-1"><input type="text" name="unitSell" id="unitSell" class="form-control" required />
                </div>
				<div class="col-lg-4"><input type="text" name="description" id="description" class="form-control" required />
                </div>
                

            </div>
            <br/>

            <div class="row">
                <div class="col-lg-3">
                    <a href="InvoiceDetail.php"> <button class="btn btn-info btn-sm formcontrol" id="save" name="save">Save </button></a>
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
            <div class="col-lg-2">
                <button class="btn btn-info btn-sm form-control" id="search" name="search" style="border-radius: 10px;">Search</button>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-info btn-sm form-control" id="open" name="open" style="border-radius: 10px;">Open</button>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-info btn-sm form-control" id="invoiceDetail" name="invoiceDetail" style="border-radius: 10px;">Invoice Details</button>
            </div>
			<div class="col-lg-2">
                <button class="btn btn-info btn-sm form-control" id="stockMaster" name="stockMaster" style="border-radius: 10px;">Stock Master</button>
            </div>
			<div class="col-lg-2">
                <button class="btn btn-info btn-sm form-control" id="debtorsTransaction" name="debtorsTransaction" style="border-radius: 10px;">Debtors Transaction</button>
            </div>
			<div class="col-lg-2">
                <button class="btn btn-info btn-sm form-control" id="debtorsMaster" name="debtorsMaster" style="border-radius: 10px;">Debtors Master</button>
            </div>
        </div>
    </form>







    <script src="bootstrap/js/jquery.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script>
        function displayTotal() {
            document.getElementById("subTotal").innerHTML
        }
    </script>
    <script>
        function refreshPage() {
            window.location.reload();
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</body>

</html>