<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>codeigniter Facebook Google Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Language" content="en-us"/>
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="imagetoolbar" content="no"/>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
<link href="/css/main.css" media="all" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="wrapper">
	<div class="slim container">
		<div class="row">
			<div class="box01">
				<div class="login-window">
					<div id="header">
						<h1>Login</h1>
					</div>
					
					<div id="connect-with-buttons">
						<a href="<?php echo FRONTEND_URL;?>auth_oa2/session/facebook" class="connect-with-button account-sprites account-sprites-facebook" title="Facebook Connect">FB</a>
						<a href="<?php echo FRONTEND_URL;?>auth_oa2/session/google" class="connect-with-button marginleft13 account-sprites account-sprites-google" title="Google">Google</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>