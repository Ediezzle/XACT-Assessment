<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initialscale=1.0">
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
<title>Debtors Master</title>
</head>

<body>
<form action="debtors_master_input.php" method="post">
	<div class="container bg-info">
		<h3>Debtors Master Form </h3>
		<div class="row">
			<div class="col-lg-3"> Account Code</div>
			<div class="col-lg-3">
				<input type="text" name="sid" id="sid" class="form-control" required /></div>
			<div class="col-lg-3">First Name</div>
			<div class="col-lg-3">
				<input type="text" name="fn" id="fn" class="form-control" required /> 
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-lg-3">Middle Name</div> 
			<div class="col-lg-3"> 
				<input type="text" name="mn" id="mn" class="form-control" required/>
			</div> 
			<div class="col-lg-3">Surname</div> 
			<div class="col-lg-3"> 
				<input type="text" name="sn" required id="sn" class="form-control" /> 
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-lg-3">Sales Year To Date</div> 
            <div class="col-lg-3">
			<input type="text" name="sytd" required id="sytd" class="form-control" />
            </div>
			<div class="col-lg-3">Cost Year To Date</div> <div class="col-lg-3"> <input type="text" name="cytd" id="cytd" required class="form-control"/> </div>
		</div>
		</br>
		<div class="row">
			<div class="col-lg-3">Address 1:</div> 
			<div class="col-lg-3">
				<input type="text" name="address1" id="address1" class="form-control" required/>
			</div>
            
			<div class="col-lg-3">Address 2:</div>
			<div class="col-lg-3">
				<input type="text" name="address2" id="address2" class="form-control" required/>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-lg-3"> Address 3</div> 
			<div class="col-lg-3">
				<input type="text" name="address3" id="address3" class="form-control" required/>
			</div>
			<div class="col-lg-3">Balance</div>
			<div class="col-lg-3">
				<input type="text" name="dept" id="dept" class="form-control" required />
			</div>
		</div>
	<br/>
	<div class="row">
		<div class="col-lg-2">
			<button class="btn btn-info btn-sm formcontrol" id="save" name="save">Save </button>
		</div>
		<div class="col-lg-2">
			<button class="btn btn-info btn-sm form-control" id="open" name="open">Open</button>
		</div>
		<div class="col-lg-3">
			<button class="btn btn-info btn-sm form-control" id="search" name="search">Search</button>
		</div>
        <div class="col-lg-2">
			<button class="btn btn-info btn-sm form-control" id="edit" name="edit">Edit</button>
		</div>
        <div class="col-lg-3">
			<button class="btn btn-info btn-sm form-control" id="delete" name="delete">Delete</button>
		</div>
	</div>
	<br/>
	</div>
</form>
<script src="bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.js" type="text/javascript"></script>
</body>
</html>