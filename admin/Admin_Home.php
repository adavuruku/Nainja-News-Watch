
<?php
session_start(); 
require_once '../settings/connection.php';
require_once '../settings/filter.php';

if(!isset($_SESSION['Admin_user_name']) AND !isset($_SESSION['Admin_user_full_name']))
{
	header("location: ../exam_logout.php");
}

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
		
			<div  class="col-sm-2 col-md-2 col-lg-2"  >
				<!-- display user details like passport ..name.. ID ..Class type -->
			</div>
				<div  class="col-sm-8 col-md-8 col-lg-8">
					<div  class="col-lg-12" style="width:100%; padding-top:5px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						<h3 style="text-align:center;color:white">Nainja News Watch | Admin Control Home</h3>
						<h5 style="text-align:center;color:yellow">Welcome	- Jounarlist <?php echo $_SESSION['Admin_user_full_name'];?> - <a style="color:white" href="../exam_logout.php">Log Out</a></h5>
					</div>
					<div  class="col-sm-12 col-md-12 col-lg-12"  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:0px; padding-bottom:5px; background-color:CadetBlue;margin-bottom:1%">
						<div  class="col-sm-6 col-md-6 col-lg-6">
						<div class="nav-head"><h4>Admin Control Pannel - Products</h4></div>
							<div class="list-group show" style="margin-bottom:20px">
								
								<a href="#" class="list-group-item"> </a>
								<a href="upload_news_step_one.php" class="list-group-item"><span class="glyphicon glyphicon-plus glysize"></span> Upload News </a>
								<a href="#" class="list-group-item"> </a>
								<a href="Upload_Video.php" class="list-group-item"><span class="glyphicon glyphicon-plus glysize"></span> Upload Videos </a>
								<a href="#" class="list-group-item"> </a>
							</div>
						</div>
						<div  class="col-sm-6 col-md-6 col-lg-6">
							<div class="nav-head"><h4>Admin Delete</h4></div>
							<div class="list-group show" style="margin-bottom:20px">
								<a href="#" class="list-group-item"> </a>
								<a href="Delete_Old_News.php" class="list-group-item"><span class="glyphicon glyphicon-plus glysize"></span> Remove / Delete News </a>
								<a href="#" class="list-group-item"> </a>
							</div>
						</div>
						
					</div>
					
					<div  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						
					</div>
				</div>		
				
				<div  class="col-sm-2 col-md-2 col-lg-2"></div>
				
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
