<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Classic Models</title>
    <meta name="description" content="Classic Models Admin Panel.">
    <link rel="stylesheet" href="cm.php">
    <script src=""></script>
</head>

<body>

<?php 

include 'header.php'; 
require_once 'cmconfig.php';

//<!----- Code adapted Web App Dev lecture notes and W3schools ----->//
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT productLine, textDescription,  image FROM productlines";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Product</th><th>Description</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["productLine"]. "</td><td>" . $row["textDescription"]. " " . $row["image"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
    
include 'footer.php'; ?>

</body>
</html>