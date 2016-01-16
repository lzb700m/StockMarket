<?php
	session_start();
	require_once("includes/config.php");

	if (isset($_SESSION['user'])) {
		header("Location: index.php");
	}

	require_once("includes/database.php");

	if (isset($_POST['signin_confirm_btn'])) {
		
		$email    = mysqli_real_escape_string($db, $_POST['email']);
		$password = md5(mysqli_real_escape_string($db, $_POST['password']));
		
		$sql  = "SELECT * FROM user WHERE email = '$email';";
		$rows = mysqli_fetch_array(mysqli_query($db, $sql), MYSQLI_ASSOC);
		
		if (($rows != NULL) && ($rows['password'] == $password)) {
			$_SESSION['user'] = $rows['id'];
			header("Location: index.php");
		} else {
	?>
			<script type="text/javascript">bootbox.alert("Incorrect user name or password, please try again.");</script>
	<?php
		}	
	}
	require_once(TEMPLATES_PATH . "includes/head.php");
	require_once(TEMPLATES_PATH . "includes/header.php");
?>
<div class="container">
	<div class="jumbotron">
		<p>Log in to see your portfolio, buy and sell your stock. And you can also add as many as you want your favorate stocks in you watchlist!</p>
	</div>
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>Sign In</strong></h3>
				<div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
			</div>
			<div class="panel-body">
				<form role="form" method="POST" action="">
					<div class="alert alert-danger" id="signin_error_message">
						<!--<a class="close" data-dismiss="alert" href="#">×</a>--><span>This goes the error message</span>
					</div>
					<div class="form-group">
						<input type="email" name="email" id="signin_email" class="form-control" placeholder="Email Address" tabindex="3">
					</div>
					<div class="form-group">
						<input type="password" name="password" id="signin_password" class="form-control" placeholder="Password" tabindex="4">
					</div>
					<button type="submit" name="signin_confirm_btn" class="btn btn-success">Sign in</button>
					<hr style="margin-top:10px;margin-bottom:10px;">
					<div class="form-group">
						<div style="font-size:85%">
							Does not have an account yet?
							<a href="signup.php">Sign up here</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	require_once(TEMPLATES_PATH . "includes/footer.php");
?>
