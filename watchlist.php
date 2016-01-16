<?php
    session_start();
    require_once("includes/config.php");
    
    require_once("includes/database.php");
    
    
    require_once(TEMPLATES_PATH . "includes/head.php");   
       require_once(TEMPLATES_PATH . "includes/header.php");
    ?>
<div class="container">
    <div class="jumbotron">
        <h2>Here is your favorite stocks.</h2>
        <p>You can buy your favorite stocks from here.</p>
    </div>
    <h3>Watchlist</h3>
    <table class="table table-bordered">
    <tr>
        <th>Symbol</th>
        <th>Name</th>
        <th>Price</th>
        <th>Change</th>
        <th>Volume</th>
        <th>Market_cap</th>
        <th>High</th>
        <th>Low</th>
        <th>Avg</th>
        <th>Action</th>
    </tr>
    <?php
        $user_id = $_SESSION['user'];
        $sql = "SELECT stock_symbol FROM watchlist WHERE user_id = '$user_id';";
        $result = mysqli_query($db, $sql);
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        	require_once('includes/class.stockMarketAPI.php');
        	$StockMarketAPI = new StockMarketAPI;
        	$StockMarketAPI->symbol = $row['stock_symbol'];
        	$info = ($StockMarketAPI->getData());
        	echo "<tr>";
        	echo "<td name='buy_company_symbol'>",$StockMarketAPI->symbol,"</td>";
        	foreach($info as $i){
        		echo "<td>",$i[name],"</td>";
        		echo "<td name='unit_price'>",$i[price],"</td>";
        		echo "<td>",$i[change],"</td>";
        		echo "<td>",$i[volume],"</td>";
        		echo "<td>",$i[market_cap],"</td>";
        		echo "<td>",$i[fiftytwo_week_high],"</td>";
        		echo "<td>",$i[fiftytwo_week_low],"</td>";
        		echo "<td>",$i[fiftyday_moving_avg],"</td>";
        		echo "<td>";
        		
        		echo "<input class='input-xs' type='number' name='ammount' min=1 size='1'>";
        		echo "<button class='btn btn-xs btn-primary' name='buy_stock_btn'>Buy</button>";
        		
        		echo "<button class='btn btn-xs btn-danger' name='remove_watchlist_btn'>Remove</button>";
        		echo "</td>";
        	}
        	echo "</tr>";
        }
        echo "</table>";
        mysqli_close($db);
        ?>
</div>
<?php
    require_once(TEMPLATES_PATH . "includes/footer.php");
    ?>