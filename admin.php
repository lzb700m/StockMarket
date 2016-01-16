<?php
    session_start();
       // load up your config file
       require_once("includes/config.php");
        
       require_once(TEMPLATES_PATH . "includes/head.php");
       require_once(TEMPLATES_PATH . "includes/header.php");    
    ?>
<div class="container">
    <div class="jumbotron">
        <h3>This is the admin page</h3>
        <p>This page is for demostration purpose only. As in this application, the product is stock, it is an open market, therefore administrator of this website is not supposed to add or remove stock product.</p>
    </div>
</div>
<?php
    require_once(TEMPLATES_PATH . "includes/footer.php");
    ?>