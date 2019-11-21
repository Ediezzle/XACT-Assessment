<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Debtors Master Input</title>
</head>

<body>
<?php
include_once 'connections.php';
if (isset($_POST['save'])) {
$ac = $_POST['ac'];
$fn = $_POST['fn'];
$mn = $_POST['mn'];
$sn = $_POST['sn'];
$gender = $_POST['gender'];
$degree = $_POST['degree'];
$address = $_POST['address'];
$cellphone = $_POST['cellphone'];
$email = $_POST['email'];
$dept = $_POST['dept'];
	
$insertq = "INSERT INTO Registration VALUES('$sid', '$fn',
'$sn', '$dob', '$gender', '$degree', '$address', '$cellphone',
'$email', '$dept')";

if ($conn->query($insertq) === TRUE) {
    echo "Records have been added successfully!";
} else {
    echo "Error adding records!: " . $conn->error;
}
echo "<br>";
$conn->close();
}
?>
</body>
</html>