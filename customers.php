<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <title>Classic Models</title>
    <meta name="description" content="Classic Models Admin Panel.">
    <link rel="stylesheet" href="cm.css">
    <script src="cm.js"></script>
</head>

<body>
<!----- Code adapted Web App Dev lecture notes example/practicals and W3schools ----->
    <?php
    include 'header.php';
    require_once 'cmconfig.php';
 
    try {
        $conn = new PDO("mysql:dbname=$dbname;charset=utf8", $username, $password);
        
 
    $sql = 
        "SELECT country, customerNumber as ID, customerName, city, phone, creditLimit, salesRepEmployeeNumber          
        FROM customers
        Order BY Country";
    ;
 
    $q = $conn->query($sql);
    
    $q->setFetchMode(PDO::FETCH_ASSOC);
 
    } 
    catch (PDOException $pe) {
        die("Could not connect to the database $dbname :" . $pe->getMessage());
    }
?>

        <div id="container">

            <table class="custable">
                <thead>
                    <tr>
                        <th>Country</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($r = $q->fetch()): ?>

                    <tr>
                        <td>
                            <?php echo htmlspecialchars($r['country'])?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['ID']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['customerName']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($r['city']); ?>
                        </td>


                        <div>
                            <td>
                                <?php 
                            
                            $text = "Name: " . htmlspecialchars($r['customerName']) . "<br>"; 
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



        <?php include 'footer.php'; ?>
</body>

</html>