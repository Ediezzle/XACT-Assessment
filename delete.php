<!DOCTYPE html>
<html>

<head>
    <title>Delete Data Using PHP- Demo Preview</title>
    <meta content="noindex, nofollow" name="robot">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="maindiv">
        <div class="divA">
            <div class="title">
                <h2>Delete Data Using PHP</h2>
            </div>
            <div class="divB">
                <div class="divD">
                    <p>Click On Menu</p>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "employee";
                    // Eastablishing Connection With Server.
                    $conn = new mysqli($servername, $username, $password, $database);

                    //$db = mysql_select_db("employee", $connection); // Selecting Database From Server.
                    if (isset($_GET['del'])) {
                        $del = $_GET['del'];
                        //SQL query for deletion.
                        $deleteq = "DELETE FROM employee WHERE employee_id=$del";
                        $result = $conn->query($deleteq) or  die("Connection failed: " . $conn->connect_error);
                    }
                    $retrieveq = "SELECT * FROM employee";
                    $res = $conn->query($retrieveq) or  die("Connection failed: " . $conn->connect_error);
                    // SQL query to fetch data to display in menu.
                    foreach ($res as $row) {
                        echo "<b><a href='delete.php?id={$row['employee_id']}'>{$row['name']}</a></b>";
                        echo "<br />";
                    }
                    ?>
                </div><?php
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            // SQL query to Display Details.
                            $deleteq = "SELECT * FROM employee WHERE employee_id=$id";
                            $r = $conn->query($deleteq) or  die("Connection failed: " . $conn->connect_error);

                            foreach ($r as $row1) {
                                ?>
                        <form class="form">
                            <h2>---Details---</h2>
                            <span>Name:</span> <?php echo $row1['name']; ?>
                            <span>E-mail:</span> <?php echo $row1['email']; ?>
                            <span>Contact No:</span> <?php echo $row1['contactNumber']; ?>
                            <span>Address:</span> <?php echo $row1['address']; ?> 
                            <?php echo "<b><a href='delete.php?del={$row1['employee_id']}'><input type='button' class='submit' value='Delete'></a></b>"; ?> </form><?php
   }
 }
 // Closing Connection with Server.
$conn->close();
  ?> 
  <div class="clear">
            </div>
        </div>
        <div class="clear"></div>
    </div>
</body>

</html>