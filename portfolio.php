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
        <h3>Portfolio</h3>
        <p>Here is the stocks you currently have invested.</p>
    </div>
    <h3>Your portfolio</h3>
    <table class="table table-bordered">
    <tr>
        <th>Symbol</th>
        <th>Shares</th>
        <th>Name</th>
        <th>Price</th>
        <th>Change</th>
        <th>High</th>
        <th>Low</th>
        <th>Avg</th>
        <th>Action</th>
    </tr>
    <?php
        $sql = "SELECT stock_symbol, SUM(shares) FROM transaction WHERE user_id = '$user_id' GROUP BY stock_symbol HAVING SUM(shares) < 0;;";
        
        $result = mysqli_query($db, $sql);
        
        while ($row = mysqli_fetch_array($result)) {
        	
        	require_once('includes/class.stockMarketAPI.php');
        	$StockMarketAPI = new StockMarketAPI;
    		$StockMarketAPI->symbol = $row['stock_symbol'];
    		$shares=-1 * $row['SUM(shares)'];
        	$info = ($StockMarketAPI->getData());
        
        	echo "<tr>";
        	echo "<td name='sell_stock_symbol'>",$StockMarketAPI->symbol,"</td>";
        	echo "<td name='sell_shares'>",$shares,"</td>";
        	foreach($info as $i) {
        		echo "<td>",$i[name],"</td>";
        		echo "<td name='unit_price'>",$i[price],"</td>";
        		echo "<td>",$i[change],"</td>";
        			
        		echo "<td>",$i[fiftytwo_week_high],"</td>";
        		echo "<td>",$i[fiftytwo_week_low],"</td>";
        		echo "<td>",$i[fiftyday_moving_avg],"</td>";
        		echo "<td>";
        			
        		echo "<input class='input-xs' type='number' name='ammount' min=1 size='1'>";
        		echo "<button class='btn btn-xs btn-primary' name='sell_stock_btn'>Sell</button>";
        		echo "</td>";
        	}
        }
        echo "</table>";
        
        ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "includes/footer.php");
    ?>