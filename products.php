<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Classic Models</title>
    <meta name="description" content="Classic Models Admin Panel.">
    <link rel="stylesheet" href="cm.css">
    <script src=""></script>
</head>

<body>
  

<!----- PHP connection adapted from Web App Dev lecture notes and W3schools ----->
<?php 


include 'header.php'; 
require_once 'cmconfig.php'; 
?>
    
<div class="container">
    <div class="main">
           <?php if(isset($_POST['submit']))
{ $t = $_POST['submit'];
 echo "<h9> ".$t."</h9>";
 
     try {
        $conn = new PDO("mysql:dbname=$dbname", $username, $password);
 
$sql = 
    "SELECT productLine, productCode as ID, productName, productScale, productVendor, productDescription, quantityInStock, buyPrice, MSRP
    FROM products where productLine ='$t' ";
    ;
 
    $q = $conn->query($sql);
    
    $q->setFetchMode(PDO::FETCH_ASSOC);
 
    } 
    catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
    
} ?>
        <form action='' method="post">
<!----- Code adapted from https://www.formget.com/php-select-option-and-php-radio-button/ ----->
            
            <h9><label class="heading">Select Product <br> to show product details:</label></h9><br><br>
            <input name="submit" type="submit" value="Classic Cars"><br><br>
            <input name="submit" type="submit" value="Motorcycles"><br><br>

            <input name="submit" type="submit" value="Planes"><br><br>
            <input name="submit" type="submit" value="Ships"><br><br>
            <input name="submit" type="submit" value="Trains"><br><br>
            <input name="submit" type="submit" value="Trucks and Buses"><br><br>
            <input name="submit" type="submit" value="Vintage Cars"><br><br>
            
        </form>
    </div>
</div>
  


<div id="container">


<table id = "ptable">
     <thead>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Scale</th>
            <th>Vendor</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>MSRP</th>
        </tr>
         <tr></tr>

    </thead>
    <tbody>

<?php
                    
if (isset($_POST['submit'])) {

}                   if(isset($_POST['submit']))
{
                    while ($r = $q->fetch()):  ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['ID'])?></td>                       
                        <td><?php echo htmlspecialchars($r['productName'])?></td>
                        <td><?php echo htmlspecialchars($r['productScale']); ?></td>
                        <td><?php echo htmlspecialchars($r['productVendor']); ?></td>                        <td><?php echo htmlspecialchars($r['productDescription']); ?></td>                        <td><?php echo htmlspecialchars($r['quantityInStock']); ?></td>
                       <td><?php echo htmlspecialchars($r['buyPrice']); ?></td>  <td><?php echo htmlspecialchars($r['MSRP']); ?></td>
                    </tr>
                    <?php endwhile; } ?>
                </tbody>
            </table>
        </div>


 
    <?php

include 'footer.php'; ?>

</body>
    
</html>