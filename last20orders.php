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
    require_once 'cmconfig.php';
 
    try {
        $conn = new PDO("mysql:dbname=$dbname", $username, $password);
 
    $sql = 
        
        "SELECT o.orderNumber, o.orderDate, o.requiredDate, o.shippedDate, o.status, o.comments, o.customerNumber, c.customerNumber, c.customerName, c.phone, c.creditLimit, c.salesRepEmployeeNumber
        FROM orders o, customers c
        WHERE o.customerNumber = c.customerNumber
        ORDER BY o.orderDate DESC
        LIMIT 20";
 
    $q = $conn->query($sql);
    
    $q->setFetchMode(PDO::FETCH_ASSOC);
 
    } 
    catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
?>

        <div id="container">
            <h8>Last 20 Orders</h8>
            <table id="last20table">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Date Ordered</th>
                        <th>Status</th>
                        <th>Date Required</th>
                        <th style="white-space: nowrap;"> Comment Section</th>
                        <th>Customer Number</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $q->fetch()): ?>
                    <tr>
                        <td>
                            <?php echo  "<form method='post'> <input type='radio' onclick=\'ordersDispaly'> </form>" . htmlspecialchars($r['orderNumber'])?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['orderDate']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['status']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['requiredDate']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['comments']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['customerNumber']); ?>
                        </td>



                        <div>
                            <td>
                                <?php 
                            
                            $text = "Phone Number: " . htmlspecialchars($r['phone']) . "<br>";
                            $text .= "Sales Rep: " . htmlspecialchars($r['salesRepEmployeeNumber']) . "<br>";
                            $text .= "Credit Limit: " . htmlspecialchars($r['creditLimit']) . "<br>";
      
                            echo "<button onclick=\"myFunction('$text')\">Show More</button>";
                            
                            ?> </td>
                        </div>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div id="details" style="display:none;">
            <span><h1> More details:</h1></span>
        </div>
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
        </script>



</body>

</html>