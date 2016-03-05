<?php
	$colorLoginNotif	= '';
	$textLoginNotif		= '';

	if(isset($_POST['btnLogin'])){
		$postUsername = $_POST['loginUsername'];
		$postPassword = $_POST['loginPassword'];

		$loginQry = "SELECT * FROM user WHERE username = '".$postUsername."' AND password = '".$postPassword."'";
		if($resultLogin = mysqli_query($conn, $loginQry)){
			if (mysqli_num_rows($resultLogin) != 0) {
				$rowLogin = mysqli_fetch_array($resultLogin);
				$_SESSION['login']  	= 'logged';
				$_SESSION['firstName']  = $rowLogin['firstName'];
				$_SESSION['lastName'] 	= $rowLogin['lastName'];
				$_SESSION['email']  	= $rowLogin['email'];
				$_SESSION['privilege']  = $rowLogin['privilege'];
				$_SESSION['iduser']		= $rowLogin['iduser'];
				$_SESSION['username']	= $rowLogin['username'];

				$logingContentText = "Username : ".$_SESSION['username']."<br>Name : ".$_SESSION['firstName']." ".$_SESSION['lastName'];
    			logging($now, $postUsername, "User Login Success", $logingContentText, $iduser);
				header('Location: ./');
			}else{
				$_SESSION['login']	= 'notlogged';
				$colorLoginNotif	= 'red-text';
				$textLoginNotif		= 'Username or Password Wrong..';
			}
		}
	}
?>
<div class="row">
	<div class="col s12">
		<div class="login-panel col offset-m3 offset-l4 s12 m6 l4 z-depth-5">
			<form action="#" method="post" enctype="multipart/form-data">
				<div class="col s12 center">
					<h4>LOGIN</h4>
				</div>
				<div class="input-field col s12">
					<input id="loginUsername" name="loginUsername" type="text" class="validate" required>
					<label for="loginUsername">Username</label>
				</div>
				<div class="input-field col s12">
					<input id="loginPassword" name="loginPassword" type="password" class="validate" required>
					<label for="loginPassword">Password</label>
				</div>
				<div class="input-field col s12">
					<button type="submit" name="btnLogin" class="waves-effect waves-light btn green darken-4 right"><i class="material-icons left">send</i>Login</button>
				</div>
				<div class="input-field col s12 mb-50">
					<span class="<?php echo $colorLoginNotif; ?>"><?php echo $textLoginNotif; ?></span>
				</div>
			</form>
		</div>
	</div>
</div>