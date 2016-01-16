<?php
    /*
    //Database configuration for cloud9 IDE
    
    $dbserver = getenv('IP');
    $dbuser = getenv('C9_USER');
    $dbpassword = "";
    $dbname = "cs6314_stock_market";
    $dbport = 3306;
    */
    
    // MAMP local MySQL instance configuration
    $dbserver   = "localhost";
    $dbuser     = "root";
    $dbpassword = "root";
    $dbname     = "cs6314_stock_market";
    $dbport     = 8889;
    
    
    // Create connection
    $db = mysqli_connect($dbserver, $dbuser, $dbpassword, $dbname);
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . mysql_error());
    }
    
    if (!mysqli_select_db($db, 'cs6314_stock_market')) {
        die('oops database selection problem ! --> ' . mysql_error());
    }
?>