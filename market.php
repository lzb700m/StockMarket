<?php
    session_start();
    require_once("includes/config.php");
    require_once(TEMPLATES_PATH . "includes/head.php");
    require_once(TEMPLATES_PATH . "includes/header.php");
    ?>
<div class="container">
    <div class="jumbotron">
        <h2>Market information from NASDAQ</h2>
        <p>All the market information is updated so that you won't miss a thing of what is happening. You can SEARCH and SORT by company name, symbol, sector and industry.</p>
    </div>
    <div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>Symbol</th>
                    <th>Name</th>
                    <th>LastSale</th>
                    <th>MarketCap</th>
                    <th>IPOyear</th>
                    <th>Sector</th>
                    <th>Industry</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    function readCSV($csvFile){
                    $file_handle = fopen($csvFile, 'r');
                    while (!feof($file_handle) ) {
                        $line_of_text[] = fgetcsv($file_handle, 1024);
                    }
                    fclose($file_handle);
                    return $line_of_text;
                    }
                    $csvFile = 'includes/companylist.csv';
                    
                    $csv = readCSV($csvFile);
                    
                    for($i=1;$i<sizeof($csv);$i++){
                        echo "<tr>";
                        echo "<td>",$csv[$i][0],"</td>";
                        echo "<td>",$csv[$i][1],"</td>";
                        echo "<td>",$csv[$i][2],"</td>";
                        echo "<td>",$csv[$i][3],"</td>";
                        echo "<td>",$csv[$i][4],"</td>";
                        echo "<td>",$csv[$i][5],"</td>";
                        echo "<td>",$csv[$i][6],"</td>";
                        echo "</tr>";
                    }
                    
                    echo "</tbody>";
                    
                    ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    require_once(TEMPLATES_PATH . "includes/footer.php");
    ?>
