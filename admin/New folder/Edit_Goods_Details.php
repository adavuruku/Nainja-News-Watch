
<?php
session_start(); 
require_once '../settings/connection.php';
require_once '../settings/filter.php';
$hide =$g_price =$g_subcategory=$g_category=$g_description =$g_name=$goods_id =$folder_name=$err = "";
if(!isset($_SESSION['Admin_user_name']) AND !isset($_SESSION['Admin_user_full_name']))
{
	header("location: ../exam_logout.php");
}

if(!isset($_GET['former_trans_code']))
{
	if(!isset($_POST['hide'])){
			header("location: ../exam_logout.php");
	}else{
				$hide = $_SESSION['search_id'] = $_POST['hide'];
	}
}else{
	//Retrieve details
	$hide = $_SESSION['search_id'] = $_GET['former_trans_code'];

	$stmt = $conn->prepare("SELECT * FROM store_goods where product_id=?  AND status=? Limit 1");
	$stmt->execute(array($_GET['former_trans_code'],"0"));
	if ($stmt->rowCount () == 1)
	{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			{
				$g_price =$row['price'];
				$g_subcategory=$row['sub_category'];$g_category=$row['category'];$g_description =$row['details'];$g_name=$row['product_name'];
			}
	}

}


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Submit_odas']))
{
		$g_price = $_POST['g_price'];
		//$g_subcategory=$_POST['g_subcategory'];
		$g_category=$_POST['g_category'];
		$g_description =$_POST['g_description'];
		$g_name=$_POST['g_name'];
		
	//check for empty
	if($g_price!=""  && $g_category!="" && $g_description!="" && $g_name!="" && $g_price > 0)
	{
		//insert record to Database
		
		$stmt = $conn->prepare("UPDATE store_goods SET product_name = ?,category = ?,price = ?,details = ? WHERE product_id=? And status=? Limit 1");
		$stmt->execute(array($g_name,$g_category,$g_price,$g_description,$_SESSION['search_id'],"0"));
		$affected_rows = $stmt->rowCount();
		if($affected_rows==1){
			$err = '<p style="color:white"> Record Updated - Successfully</p>';
		}else{
			$err = '<p style="color:white"> Error : Unable to Updated Record</p>';
		}		
					
	}else
	{
		$err = '<p style="color:red">Error :Some Fields are Empty</p>';
	}

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>The Profiler</title>
<link rel="shortcut icon" href="../settings/images/headlogo.jpg">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../settings/css/bootstrap-theme.css" >
<script type="text/javascript" src="../settings/js/bootstrap.js"></script>
<script type="text/javascript" src="../settings/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../settings/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="../settings/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../settings/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../settings/edit_goods.js"></script>
</head>
<body style="padding-top:2%;font-family:Tahoma, Times, serif;font-weight:bold;" onload="write_data()">


<div class="container" style="padding-top:5px;">
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
		<div class="row">
		
			<div  class="col-sm-2 col-md-2 col-lg-2"  >
				<!-- display user details like passport ..name.. ID ..Class type -->
			</div>
				<div  class="col-sm-8 col-md-8 col-lg-8">
					<div  class="col-lg-12" style="width:100%; padding-top:5px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						<h3 style="text-align:center;color:white">The Profiler System</h3>
						<h5 style="text-align:center;color:yellow">Welcome	-	Administrator <?php echo $_SESSION['Admin_user_full_name'];?> - <a style="color:white" href="../exam_logout.php">Log Out</a> | <a style="color:yellow" href="Edit_Goods_In_Stock.php">Goods List</a> | <a style="color:white" href="Admin_Home.php">Admin Home</a></h5>
					</div>
					<div  class="col-sm-12 col-md-12 col-lg-12"  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:0px; padding-bottom:5px; background-color:CadetBlue;margin-bottom:1%;color:yellow">
				
							<h4>&darr; Update Goods (Products) &darr;</h4>
						<hr/>
						
						<div class="col-xs-10 col-sm-10" style="//display: none;" >
						<form role="form"  name="reg_form"  id="form" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
						<div class="form-group">
									<label for="g_name" class="control-label col-xs-3">Goods Names :<span style="color:red" class"require">*</span></label>
										<div class="col-xs-9">
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
													<input type="text"  class="text_field form-control"  id="g_name" name="g_name" value="<?php echo $g_name; ?>" placeholder="Enter Goods Name" >
											</div>
										</div>
							</div>
							<p id="desc" style="display:none;" ><?php echo $g_description; ?></p>
							<div class="form-group">
									<label for="g_description" class="control-label col-xs-3">Description :<span style="color:red" class"require">*</span></label>
										<div class="col-xs-9">
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
													<textarea    class="form-control"  id="g_description" name="g_description"  placeholder="Enter Goods Descriptions"></textarea>
											</div>
										</div>
								</div>
							<div class="form-group">
									<label for="g_category" class="control-label col-xs-3">Category :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-5">
										
											<select class="form-control"  id="g_category"  name="g_category">
													<?php echo '<option value="'.$g_category.'">'.$g_category.'</option>';?>
													<option value="Ellectronics">Ellectronics</option>
													<option value="Clothings" >Clothings</option>
													<option value="Furnitures" >Furnitures</option>
											</select>
									
									</div>
							</div>
													
								<div class="form-group">
									<label for="g_price" class="control-label col-xs-3">Price ( &#8358; ) :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-5">
										<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
													<input type="text"  onkeydown="return noNumbers(event,this)" class="text_field form-control" value="<?php echo $g_price; ?>" id="g_price" name="g_price" placeholder="Enter Price" >
											</div>
									
									</div>									
								</div>
								<input type="hidden"  name="hide" class="text_field form-control" value="<?php echo $hide; ?>" ></input>
								<div  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:5px; padding-bottom:0px; background-color:grey;margin-bottom:1%">
									<div class="form-group">
												<label for="" class="control-label col-xs-9"><?php echo $err;?></label>
												<div class="col-xs-3">
													<div class="input-group">
															<input  type="Submit"  class="submit_btn btn btn-success"  style="width:100%;" value="Update Details" name="Submit_odas"  ></input>
													</div>
												</div>									
										</div>
									</form>
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
						<p style="text-align:center">Copyright &copy; 2016 - All Rights Reserved - Software Development Unit, A S A.</p>
					</footer>
				</div>
			<div class="col-xs-2 col-sm-2"></div>	
		</div>	
</div>	
</body>
</html>  
