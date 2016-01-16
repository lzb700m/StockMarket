<?php
session_start();

require_once("includes/config.php");

require_once(TEMPLATES_PATH . "includes/head.php");
require_once(TEMPLATES_PATH . "includes/header.php");
?>
<div class="container">
    <div class="jumbotron">
        <p>Search by stock symbol. We will provide you with the live stock price and historical data.</p>
        <form class="form-search">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div id="imaginary_container">
                        <div class="input-group stylish-input-group">
                            <input type="text" name="symbol" class="form-control" placeholder="Stock Symbol" >
                            <span class="input-group-addon">
                            <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                            </button>  
                            </span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    <?php
require_once('includes/class.stockMarketAPI.php');
$StockMarketAPI = new StockMarketAPI;

if (isset($_GET["symbol"])) {
    $StockMarketAPI->symbol = $_GET["symbol"];
    $info                   = ($StockMarketAPI->getData());
    
?>
    <h3>Current Stock Information</h3>
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
    </tr>
    <?php
    $info = ($StockMarketAPI->getData());
    echo "<tr>";
    echo "<td id='company_symbol'>", $StockMarketAPI->symbol, "</td>";
    foreach ($info as $i) {
        echo "<td>", $i[name], "</td>";
        echo "<td>", $i[price], "</td>";
        echo "<td>", $i[change], "</td>";
        echo "<td>", $i[volume], "</td>";
        echo "<td>", $i[market_cap], "</td>";
        echo "<td>", $i[fiftytwo_week_high], "</td>";
        echo "<td>", $i[fiftytwo_week_low], "</td>";
        echo "<td>", $i[fiftyday_moving_avg], "</td>";
    }
    echo "</tr>";
    echo "</table>";
?>
    <?php
    if (isset($_SESSION['user']) != '') {
?>
    <button type="button" class="btn btn-success" id="add_favorate_btn">Favorite</button>
    <?php
    }
?>

    <h3>Historical Stock Information</h3>
    <table id="datatables" class="display">
    <thead>
        <tr>
            <td>Date</td>
            <td>Open</td>
            <td>High</td>
            <td>Low</td>
            <td>Close</td>
            <td>Volume</td>
            <td>Sdj_close</td>
        </tr>
    </thead>
    <?php
    $start = "01-01-2015";
    $end   = "";
    require_once('includes/class.stockMarketAPI.php');
    $StockAPI          = new StockMarketAPI;
    $StockAPI->symbol  = $_GET["symbol"];
    $StockAPI->history = array(
        'start' => $start,
        'end' => $end,
        'interval' => 'd' // Daily
    );
    $his_info          = ($StockAPI->getData());
    
    foreach ($his_info as $row) {
        
        for ($x = 1; $x < sizeof($row); $x++) {
            echo "<tr>";
            echo "<td>", $row[$x][date], "</td>";
            echo "<td>", $row[$x][open], "</td>";
            echo "<td>", $row[$x][high], "</td>";
            echo "<td>", $row[$x][low], "</td>";
            echo "<td>", $row[$x][close], "</td>";
            echo "<td>", $row[$x][volume], "</td>";
            echo "<td>", $row[$x][adj_close], "</td>";
            echo "</tr>";
        }
        
    }
    echo "</table>";
}
?>
</div>
<?php
require_once(TEMPLATES_PATH . "includes/footer.php");
?>
