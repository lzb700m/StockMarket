<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="index.php">StockMarket</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="market.php">Market</a></li>
					<li><a href="company.php">Company</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
					if (!isset($_SESSION['user'])) {
					?>
						<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<?php
					} else {
					?>
					<li class="dropdown">
						<?php
							require_once("includes/config.php");
							require_once("includes/database.php");
							$user_id    = $_SESSION['user'];
							$sql        = "SELECT * FROM user WHERE id = '$user_id'";
							$rows       = mysqli_fetch_array(mysqli_query($db, $sql), MYSQLI_ASSOC);
							$welcomeMsg = "<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Welcome ";
							$welcomeMsg .= $rows['firstName'];
							$welcomeMsg .= " ";
							$welcomeMsg .= $rows['lastName'];
							$welcomeMsg .= "<span class='caret'></span></a>";
							echo $welcomeMsg;
						?>
						<ul class="dropdown-menu">
							<?php
								if ($rows['isAdmin'] == 1) {
									echo "<li><a href='admin.php'>Manage Site</a></li>";
								}
							?>
							<li><a href="portfolio.php">Portfolio</a></li>
							<li><a href="watchlist.php">Watchlist</a></li>
							<li><a href="transaction.php">Transaction</a></li>
							<li><a href="logout.php?logout">Logout</a></li>
						</ul>
					</li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
	</nav>