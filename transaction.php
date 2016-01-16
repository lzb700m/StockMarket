<?php
    session_start(); 
       require_once("includes/config.php");
       
       $user_id = $_SESSION['user'];
       
       require_once("includes/database.php");
    
    require_once(TEMPLATES_PATH . "includes/head.php");
    require_once(TEMPLATES_PATH . "includes/header.php");
    ?>
<div class="container">
    <div class="jumbotron">
        <h3>Here is all your transaction history.</h3>
        <p>Check your balance and track transaction history. Not enough balance to continue investing? NO PROBLEM! Click on the ads 100 times and we will fund you another $10,000.</p>
    </div>
    <h3>Transaction History</h3>
    <table class="table table-bordered">
    <tr>
        <th>Transaction Time</th>
        <th>Type</th>
        <th>Stock_symbol</th>
        <th>Shares</th>
        <th>Price</th>
        <th>Balance</th>
    </tr>
    <?php
        $sql = "SELECT * FROM transaction WHERE user_id = '$user_id' and stock_symbol !='registration' ORDER BY t_time DESC;";
        $result = mysqli_query($db, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
        
        if($row[shares]<0){
        	$shares=-1 * $row[shares];
        	echo "<tr>";
        	echo "<td>",$row[t_time],"</td>";
        	echo "<td>","Buy","</td>";
        	echo "<td>",$row[stock_symbol],"</td>";
        	echo "<td>",$shares,"</td>";
        	echo "<td>",$row[t_price],"</td>";
        	echo "<td>",$row[balance],"</td>";
        	echo "</tr>";
        }else{
        	$shares=$row[shares];
        	echo "<tr>";
        	echo "<td>",$row[t_time],"</td>";
        	echo "<td>","Sell","</td>";
        	echo "<td>",$row[stock_symbol],"</td>";
        	echo "<td>",$shares,"</td>";
        	echo "<td>",$row[t_price],"</td>";
        	echo "<td>",$row[balance],"</td>";
        	echo "</tr>";
        }	
        }
        echo "</table>";
        mysqli_close($db);
        ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "includes/footer.php");
    ?>
