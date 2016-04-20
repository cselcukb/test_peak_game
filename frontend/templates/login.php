<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo $site_root.'/frontend/css/boot.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $site_root.'/frontend/css/signin.css'; ?>" />
	</head>
	<body>
		<?php if(isset($warning_message)){
			echo $warning_message;
		} ?>
    <div class="container">
      <form action="" method="POST" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="username" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div> <!-- /container -->
	</body>
</html>
