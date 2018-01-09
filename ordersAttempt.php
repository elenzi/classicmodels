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

    <?php
    include 'last20orders.php';
    include 'header.php';
    require_once 'cmconfig.php';
 
    try {
        $conn = new PDO("mysql:dbname=$dbname", $username, $password);
 
    $sql = 
        
        "SELECT DISTINCT o.orderNumber, o.orderDate, o.requiredDate, o.shippedDate, o.status, o.comments, o.customerNumber, c.customerNumber, c.customerName, c.phone, c.creditLimit, c.salesRepEmployeeNumber, od.orderNumber, od.productCode, od.orderLineNumber, p.productName
        FROM orders o
        JOIN products p
        JOIN customers c on o.customerNumber = c.customerNumber
        JOIN orderdetails od on o.orderNumber = od.orderNumber
        where o.status = 'In Process'";
 
    $q = $conn->query($sql);
    
    $q->setFetchMode(PDO::FETCH_ASSOC);
 
    } 
    catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
?>

        <div id="container">
            <h8>Orders in Process</h8>
            <table id="orderstable">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Date Ordered</th>
                        <th>Status</th>
                        <th>Date Required</th>
                        <th style="white-space: nowrap;">Comment Section</th>
                        <th>Customer Number</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $q->fetch()): ?>
                    <tr>
                        <td>
                            <?php echo  "<form method='post'> <input type='radio' onclick=\'ordersDispaly('$otext')\'> </form>" . htmlspecialchars($r['orderNumber'])?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['o.orderDate']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['o.status']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['o.requiredDate']); ?>
                        </td>
                        <td id="commentTD">
                            <?php echo htmlspecialchars($r['o.comments']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['o.customerNumber']); ?>
                        </td>



                        <div>
                            <td>
                                <?php 
                            
                            $text = "Phone Number: " . htmlspecialchars($r['phone']) . "<br>";
                            $text .= "Sales Rep: " . htmlspecialchars($r['salesRepEmployeeNumber']) . "<br>";
                            $text .= "Credit Limit: " . htmlspecialchars($r['creditLimit']) . "<br>";
      
                            echo "<button onclick=\"myFunction('$text')\">Show More</button>";
                            
                            ?> </td>
                            <td>
                                <?php 
                            
                            $otext = "Product Name: " . htmlspecialchars($r['p.productName']) . "<br>";
                            $otext = "Product Code: " . htmlspecialchars($r['od.productCode']) . "<br>";
                            $otext .= "Product Line: " . htmlspecialchars($r['od.orderLineNumber']) . "<br>";
                            $otext .= "Credit Limit: " . htmlspecialchars($r['creditLimit']) . "<br>";  $otext .= "Comments: " . htmlspecialchars($r['o.comments']) . "<br>";
    
                            
                            ?> </td>
                        </div>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div id="details" style="display:none;">

            <span><h1> More details:</h1></span></div>

        <div id="odetails" style="display:none;"></div>

        <script>
            function myFunction(msg) {
                document.getElementById("details").innerHTML = msg;
                var x = document.getElementById("details");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }

            function ordersDisplay(msg) {
                document.getElementById("odetails").innerHTML = msg;
                var x = document.getElementById("odetails");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>



        <?php include 'footer.php'; ?>


</body>

</html>