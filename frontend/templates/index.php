<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo $site_root.'/frontend/css/bootstrap.min.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo $site_root.'/frontend/css/main.css'; ?>" />
	</head>
	<body>
		<script>
			window.fbAsyncInit = function() {
				FB.init({
				  appId      : '234891310204449',
				  xfbml      : true,
				  version    : 'v2.6'
				});
			};

			(function(d, s, id){
				 var js, fjs = d.getElementsByTagName(s)[0];
				 if (d.getElementById(id)) {return;}
				 js = d.createElement(s); js.id = id;
				 js.src = "//connect.facebook.net/en_US/sdk.js";
				 fjs.parentNode.insertBefore(js, fjs);
			 }(document, 'script', 'facebook-jssdk'));
		</script>
		<div class="container">
		  <?php include dirname(__FILE__)."/partials/header.php"; ?>
			<h1 class="txt-algn-cntr">Claims from Me</h1>
			<table id="claims_table" class="table txt-algn-cntr">
				<thead>
					<th class="txt-algn-cntr">Username</th>
					<th class="txt-algn-cntr">Operations</th>
				</thead>
				<tbody id="claims_table_body">
					<?php
						echo $claimContentHTML;
					?>
				</tbody>
			</table>
			<h1 class="txt-algn-cntr">Users</h1>
			<table id="users_table" class="table txt-algn-cntr">
				<thead>
					<th class="txt-algn-cntr">Username</th>
					<th class="txt-algn-cntr">Total Gifts Today from Me</th>
					<th class="txt-algn-cntr">Total Gifts</th>
					<th class="txt-algn-cntr">Operations</th>
				</thead>
				<tbody id="users_table_body">
					<?php
						echo $userContentHTML;
					?>
				</tbody>
			</table>
		</div>
		<script type="text/javascript" src="<?php echo $site_root.'/frontend/js/main.js'; ?>">
		</script>
		<script type="text/javascript" src="<?php echo $site_root.'/frontend/js/facebook_javascript_sdk_funcs.js'; ?>">
		</script>
	</body>
</html>
