<?php
    session_start();
    require_once("database.php");
    require_once("config.php");
    
    if (isset($_POST['email_check'])) {    
        $email_check = mysqli_real_escape_string($db, $_POST['email_check']);
        $sql         = "SELECT * FROM user WHERE email = '$email_check';";
        
        $result = mysqli_query($db, $sql);
        $rows = mysqli_num_rows($result);
        
        if ($rows === 0) {
            echo 'ok';
        } else {
            echo 'notok';
        }
    }
    
    if (isset($_GET['company_symbol'])) {
        $company_symbol = mysqli_real_escape_string($db, $_GET['company_symbol']);
        $user_id        = $_SESSION['user'];
        $sql            = "INSERT INTO watchlist (user_id, stock_symbol) VALUES ('$user_id', '$company_symbol');";
        
        if (mysqli_query($db, $sql)) {
            echo 'ok';
        }
    }
    
    // buy stock in watchlist
    if (isset($_GET['buy_company_symbol']) && isset($_GET['buy_ammount']) && isset($_GET['unit_price'])) {
        $buy_company_symbol = mysqli_real_escape_string($db, $_GET['buy_company_symbol']);
        $buy_ammount        = -1 * mysqli_real_escape_string($db, $_GET['buy_ammount']);
        $unit_price         = mysqli_real_escape_string($db, $_GET['unit_price']);
        $user_id            = $_SESSION['user'];    
        
        $sql = "SELECT * FROM transaction WHERE user_id = '$user_id' ORDER BY t_time DESC LIMIT 1;";
        $row = mysqli_fetch_array(mysqli_query($db, $sql), MYSQLI_ASSOC);
        
        $new_balance = $row['balance'] + ($buy_ammount * $unit_price);    
        if ($new_balance >= 0) {        
            $sql_insert = "INSERT INTO transaction (user_id, stock_symbol, shares, t_price, balance) VALUES ('$user_id', '$buy_company_symbol', '$buy_ammount', '$unit_price', $new_balance );";
            
            if (mysqli_query($db, $sql_insert)) {
                echo "ok";
            } else {
                echo "error";
            }
            
        } else {
            echo "notEnoughBalance";
        }
    }
    
    if (isset($_GET['sell_stock_symbol']) && isset($_GET['ammount']) && isset($_GET['unit_price']) && isset($_GET['sell_shares'])) {
        $sell_stock_symbol = mysqli_real_escape_string($db, $_GET['sell_stock_symbol']);
        $ammount           = mysqli_real_escape_string($db, $_GET['ammount']);
        $unit_price        = mysqli_real_escape_string($db, $_GET['unit_price']);
        $sell_shares       = mysqli_real_escape_string($db, $_GET['sell_shares']);
        $user_id           = $_SESSION['user'];
        
        if ($ammount <= $sell_shares) {
            
            $sql = "SELECT * FROM transaction WHERE user_id = '$user_id' ORDER BY t_time DESC LIMIT 1;";
            
            $row = mysqli_fetch_array(mysqli_query($db, $sql), MYSQLI_ASSOC);
            
            $new_balance = $row['balance'] + ($ammount * $unit_price);
            
            $sql_insert = "INSERT INTO transaction (user_id, stock_symbol, shares, t_price, balance) VALUES ('$user_id', '$sell_stock_symbol', '$ammount', '$unit_price', $new_balance );";
            
            if (mysqli_query($db, $sql_insert)) {
                echo "ok";
            } else {
                echo "error";
            }
        } else {
            echo "notEnoughShares";
        }    
    }
    // remove stock from watchlist
    
    if (isset($_GET['remove_symbol'])) {
        
        $remove_symbol = mysqli_real_escape_string($db, $_GET['remove_symbol']);
        $user_id       = $_SESSION['user'];
        $sql           = "DELETE from watchlist where user_id='$user_id' and stock_symbol= '$remove_symbol';";
        
        if (mysqli_query($db, $sql)) {
            echo 'ok';
        } else {
            echo 'error';
        }
        
    }
    mysqli_close($db);
    ?>