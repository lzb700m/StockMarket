<?php
	session_start();
	
	require_once( "includes/config.php");
	require_once(TEMPLATES_PATH . "includes/head.php");
	require_once(TEMPLATES_PATH . "includes/header.php");  
	
	if(isset($_SESSION['user'])!="") {
		header("Location: index.php");
	}
	
	require_once("includes/database.php");
	
	if (isset($_POST['signup_confirm_btn'])) {
	  
		$firstName = mysqli_real_escape_string($db, $_POST['first_name']);
		$lastName = mysqli_real_escape_string($db, $_POST['last_name']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = md5(mysqli_real_escape_string($db, $_POST['password']));
		$passwordConfirmation = mysqli_real_escape_string($db, $_POST['password_confirmation']);
	
		$sql_user = "INSERT INTO user (email, password, firstName, lastName) VALUES('$email', '$password', '$firstName', '$lastName'); ";
	
	
		if (mysqli_query($db, $sql_user)) {
			$sql_user_id = "SELECT * FROM user WHERE email = '$email';";
			$rows = mysqli_fetch_array(mysqli_query($db, $sql_user_id), MYSQLI_ASSOC);
			$user_id = $rows['id'];
			$sql_transaction = "INSERT INTO transaction (user_id, stock_symbol, shares, t_price, balance) VALUES ('$user_id', 'registration', 10000, 1, 10000);";
			if (mysqli_query($db, $sql_transaction)) {
			?>
				<script type="text/javascript">bootbox.alert("Signup successful. Please log in.");</script>
			<?php
			}
		}
	}
	
	mysqli_close($db);
	
	
	?>
<div class="container" style="margin-top:30px">
	<div class="jumbotron">
		<p>Did you know that by signing up, you will be awarded $10,000 to start with? Sign up NOW, and start investing today!</p>
	</div>
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><strong>Sign Up</strong></h3>
				<div style="float:right; font-size: 80%; position: relative; top:-10px"></div>
			</div>
			<div class="panel-body">
				<form role="form" method="POST" action="" onsubmit="return check_signup_table();">
					<div class="alert alert-danger" id="signup_error_message">
						<!--<a class="close" data-dismiss="alert" href="#">×</a>--><span>This goes the error message</span>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" name="first_name" id="signup_first_name" class="form-control" placeholder="First Name" tabindex="1">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="text" name="last_name" id="signup_last_name" class="form-control" placeholder="Last Name" tabindex="2">
							</div>
						</div>
					</div>
					<div class="form-group">
						<input type="email" name="email" id="signup_email" class="form-control" placeholder="Email Address" tabindex="3">
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password" id="signup_password" class="form-control" placeholder="Password" tabindex="4">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6">
							<div class="form-group">
								<input type="password" name="password_confirmation" id="signup_password_confirmation" class="form-control" placeholder="Confirm Password" tabindex="5">
							</div>
						</div>
					</div>
					<button type="submit" name="signup_confirm_btn" class="btn btn-success">Sign up</button>
					<hr style="margin-top:10px;margin-bottom:10px;">
					<div class="form-group">
						<div style="font-size:85%">
							Already have an account?
							<a href="login.php">Sign in here</a>
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