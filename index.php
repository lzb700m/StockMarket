<?php
    session_start();    
    
    require_once("includes/config.php");
    require_once(TEMPLATES_PATH . "includes/head.php");     
    require_once(TEMPLATES_PATH . "includes/header.php");
    ?>
<div class="container">
    <div class="jumbotron">
        <h2>Welcome to the Stock Market.</h2>
        <p>Get $10,000 fund on us today by signing up. Practice your portfolio risk free. *Plus, we will never charge you for commission.</p>
    </div>
</div>
<?php
    require_once(TEMPLATES_PATH . "includes/footer.php");
    ?>