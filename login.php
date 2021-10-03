<?php
	session_start();
	
	// Check if user is already logged in
	if(isset($_SESSION['loggedIn'])){
		header('Location: index.php');
		exit();
	}
	
	require_once('inc/config/constants.php');
	require_once('inc/config/db.php');
	require_once('inc/header.html');
?>
  <body style="background-image:url('bgg.jpg'); height:100%;width:auto;">

<?php
// Variable to store the action (login, register, passwordReset)
$action = '';
	if(isset($_GET['action'])){
		$action = $_GET['action'];
		if($action == 'register'){
?>
			<div class="container">
			  <div class="row justify-content-center">
			  <div class="col-sm-12 col-md-5 col-lg-5">
				<div class="card"  style="background-color:black; border-radius:50px">
				  <div class="card-header" style="color:white; text-align:center;font-size:30px;">
					Register
				  </div>
				  <div class="card-body">
					<form action="">
					<div id="registerMessage"></div>
					  <div class="form-group">
						<label for="registerFullName" style="color:white;">Name<span class="requiredIcon">*</span></label>
						<input type="text" class="form-control" id="registerFullName" name="registerFullName" placeholder="Enter your Name">
						<!-- <small id="emailHelp" class="form-text text-muted"></small> -->
					  </div>
					   <div class="form-group">
						<label for="registerUsername" style="color:white;">Username<span class="requiredIcon">*</span></label>
						<input type="email" class="form-control" id="registerUsername" name="registerUsername" autocomplete="on" placeholder="Enter your Username">
					  </div>
					  <div class="form-group">
						<label for="registerPassword1" style="color:white;">Password<span class="requiredIcon">*</span></label>
						<input type="password" class="form-control" id="registerPassword1" name="registerPassword1" name="loginPassword" placeholder="Enter your Password">
					  </div>
					  <div class="form-group">
						<label for="registerPassword2"style="color:white;">Re-enter password<span class="requiredIcon">*</span></label>
						<input type="password" class="form-control" id="registerPassword2" name="registerPassword2" placeholder="Re-Enter Password">
					  </div>
					  <a href="login.php" class="btn btn-success">Login</a>
					  <button type="button" id="register" class="btn btn-primary">Register</button>
					  <a href="login.php?action=resetPassword" class="btn btn-danger">Reset Password</a>
					  <button type="reset" class="btn">Clear</button>
					</form>
				  </div>
				</div>
				</div>
			  </div>
			</div>
<?php
			require 'inc/footer.php';
			echo '</body></html>';
			exit();
		} elseif($action == 'resetPassword'){
?>
			<div class="container">
			  <div class="row justify-content-center">
			  <div class="col-sm-12 col-md-5 col-lg-5">
				<div class="card" style="background-color:black; border-radius:50px"">
				  <div class="card-header" style="color:white; text-align:center; font-size:30px;">
					Reset Password
				  </div>
				  <div class="card-body">
					<form action="">
					<div id="resetPasswordMessage"></div>
					  <div class="form-group">
						<label for="resetPasswordUsername" style="color:white;">Username</label>
						<input type="text" class="form-control" id="resetPasswordUsername" name="resetPasswordUsername" placeholder="Enter your Username">
					  </div>
					  <div class="form-group">
						<label for="resetPasswordPassword1" style="color:white;">New Password</label>
						<input type="password" class="form-control" id="resetPasswordPassword1" name="resetPasswordPassword1" placeholder="Enter New Password">
					  </div>
					  <div class="form-group">
						<label for="resetPasswordPassword2" style="color:white;">Confirm New Password</label>
						<input type="password" class="form-control" id="resetPasswordPassword2" name="resetPasswordPassword2" placeholder="Re-Enter Password">
					  </div>
					  <a href="login.php" class="btn btn-success">Login</a>
					  <a href="login.php?action=register" class="btn btn-primary">Register</a>
					  <button type="button" id="resetPasswordButton" class="btn btn-danger">Reset Password</button>
					  <button type="reset" class="btn">Clear</button>
					</form>
				  </div>
				</div>
				</div>
			  </div>
			</div>
<?php
			require 'inc/footer.php';
			echo '</body></html>';
			exit();
		}
	}	
?>
	<!-- Default Page Content (login form) -->
    <div class="container">
      <div class="row justify-content-center">
	  <div class="col-sm-12 col-md-5 col-lg-5">
		<div class="card" style="background-color:black; border-radius:50px">
		  <div class="card-header" style="color:white; text-align:center;font-size:30px;">
			Login
		  </div>
		  <div class="card-body">
			<form action="">
			<div id="loginMessage"></div>
			  <div class="form-group">
				<label for="loginUsername" style="color:white;">Username</label>
				<input type="text" class="form-control" id="loginUsername" name="loginUsername" placeholder="Enter your Username">
			  </div>
			  <div class="form-group">
				<label for="loginPassword" style="color:white;">Password</label>
				<input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Enter your Password">
			  </div>
			  <button type="button" id="login" class="btn btn-success">Login</button>
			  <a href="login.php?action=register" class="btn btn-primary">Register</a>
			  <a href="login.php?action=resetPassword" class="btn btn-danger">Reset Password</a>
			  <button type="reset" class="btn">Clear</button>
			</form>
		  </div>
		</div>
		</div>
      </div>
    </div>
<?php
	require 'inc/footer.php';
?>
  </body>
</html>
