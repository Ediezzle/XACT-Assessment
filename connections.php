<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Database Connections File</title>
</head>

<body>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "Inventory";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
echo "<br>";
?>
</body>

</html>