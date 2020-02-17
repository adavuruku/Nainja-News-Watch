<?php
session_start();
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Home | Nainja News Watch  </title>
<link rel="shortcut icon" href="../settings/images/Nainja.jpg">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap-theme.css" >
<script type="text/javascript" src="../settings/js/bootstrap.js"></script>
<script type="text/javascript" src="../settings/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../settings/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="../settings/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../settings/js/bootstrap.min.js"></script>

</head>
<body style="padding-top:2%;font-family:Tahoma, Times, serif;font-weight:bold;">


<div class="container" style="padding-top:5px;">
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
		<div class="row">
		
			
				<div  style="text-align:center" class="col-sm-12 col-md-12 col-lg-12">
					<div  class="col-lg-12" style="width:100%; padding-top:5px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						<h3 style="text-align:center;color:white">Nainja News Watch | Admin Control Home</h3>
						<h5 style="text-align:center;color:yellow">Welcome	-	Administrator <?php echo $_SESSION['Admin_user_full_name'];?> - <a style="color:white" href="../exam_logout.php">Log Out</a> | <a style="color:white" href="Admin_Home.php">Admin Home</a></h5>
					</div>
					<div  class="col-sm-12 col-md-12 col-lg-12"   style="width:100%; padding-top:10px; padding-left:0px; padding-bottom:5px; background-color:CadetBlue;margin-bottom:1%">
						<?php
						
							$fb = new Facebook\Facebook([
							'app_id' => '630641980453868',
							'app_secret' => '4ceef71cfac1bba3bf2c1442087795c3',
							'default_graph_version' => 'v2.5',
							]);

							if(isset($_SESSION['facebook_access_token']))
							{
								echo "Acess Token = ".$_SESSION['facebook_access_token']."<br/>";
								echo "<a href='".'logout.php'."'>Log Out</a>";
								$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
								$_SESSION['facebook_access_token'] = NULL;
								$helper = $fb->getRedirectLoginHelper();
								$permissions = ['email', 'user_likes','publish_actions','publish_pages','manage_pages','public_profile']; // optional
								$loginUrl = $helper->getLoginUrl('http://localhost/NainjaNewsWatch/admin/facebook_login.php', $permissions);
								echo '<div  style="text-align:center" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <h1 ><a class="btn btn-primary btn-lg btn-block" href="' . $loginUrl . '">Click Here to Proceed !</a></h1></div>';
							}else{
								$helper = $fb->getRedirectLoginHelper();
								$permissions = ['email', 'user_likes','publish_actions','publish_pages','manage_pages','public_profile']; // optional
								$loginUrl = $helper->getLoginUrl('http://localhost/NainjaNewsWatch/admin/facebook_login.php', $permissions);
								echo '<div  style="text-align:center" class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <h1 ><a class="btn btn-primary btn-lg btn-block" href="' . $loginUrl . '">Click Here to Proceed !</a></h1></div>';
							}
						
						
						
						?>
						
					</div>
					
					<div  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						
					</div>
				</div>
				
				<div class="clearfix visible-sm-block"></div>
				<div class="clearfix visible-md-block"></div>
				<div class="clearfix visible-lg-block"></div>
		</div>
		<!-- middle content ends here where vertical nav slides and news ticker ends -->
	
		<div class="row">
			<div class="col-xs-2 col-sm-2"></div>	
				<div class="col-xs-8 col-sm-8" >
					<footer>
						<p style="text-align:center">Copyright &copy; 2017 - All Rights Reserved - Software Development Unit, Sherif A.</p>
					</footer>
				</div>
			<div class="col-xs-2 col-sm-2"></div>	
		</div>	
</div>	
</body>
</html>  