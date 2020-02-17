
<?php
session_start(); 
require_once '../settings/connection.php';
require_once '../settings/filter.php';
$g_price =$g_subcategory=$g_category=$g_description =$g_name=$goods_id =$folder_name=$err = "";
if(!isset($_SESSION['Admin_user_name']) AND !isset($_SESSION['Admin_user_full_name']))
{
	header("location: ../exam_logout.php");
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{ 
		$type = $_POST['type'];
		
		$f_day = $_POST['f_day'];
		$f_month = $_POST['f_month'];
		$f_year = $_POST['f_year'];
		
		$t_day = $_POST['t_day'];
		$t_month = $_POST['t_month'];
		$t_year = $_POST['t_year'];
		
		//$from_date = $f_day."-".$f_month."-".$f_year;
		//$to_date = $t_day."-".$t_month."-".$t_year;
		
		$from_date = $f_year."-".$f_month."-".$f_day;
		$to_date = $t_year."-".$t_month."-".$t_day;
		
		/*$date500 = new DateTime($from_date);
		$from_date_2 = date_format($date500,"Y-d-m");
		
		$date500_3 = new DateTime($to_date);
		$to_date = date_format($date500_3,"Y-d-m");*/

		
		$stmt = $conn->prepare("SELECT * FROM md_customers where (date_reg between ? AND ?) AND type=? ");
		$stmt->execute(array($from_date,$to_date,$type));
		$affected_rows = $stmt->rowCount();
		if($affected_rows >= 1) 
		{	
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$link ="?from_date=".$from_date."&to_date=".$to_date."&type=".$type;
				if($type=="A"){
					header ("location: ../store_files/Admint_Print_Bookings.php".$link);
				}else{
					header ("location: ../store_files/Admint_Print_Bookings_Two.php".$link);
				}
				
		}else{
			$err ="No Record Found";
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
<script type="text/javascript"> 
function byId(e)
    {
        return document.getElementById(e);
    }
	function fill_Date_Combo()
    {
        //alert ("sherif");
        var f_day = byId('f_day');
		var t_day = byId('t_day');
		
        var f_month = byId('f_month');
		var t_month = byId('t_month');
		
		var f_year = byId('f_year');
		var t_year = byId('t_year');
		
		emptyCombo(f_day);
		emptyCombo(t_day);
		for(var i =1; i<=31;i++){
			if(i<=9){
				var j ="0"+i;
			}else{
				var j =i;
			}
			addOption(f_day, j, j);
			addOption(t_day, j, j);
		}
		emptyCombo(f_month);
		emptyCombo(t_month);
		for(var i =1; i<=12;i++){
			
			if(i<=9){
				var j ="0"+i;
			}else{
				var j =i;
			}
			addOption(f_month, j, j);
			addOption(t_month, j, j);
		}
		emptyCombo(f_year);
		emptyCombo(t_year);
		for(var i =2016; i<=2030;i++){
			var j =i;
			addOption(f_year, j, j);
			addOption(t_year, j, j);
		}   
	}
	function emptyCombo(e)
    {
        e.innerHTML = '';
    }
 
    function addOption(combo, val, txt)
    {
        var option = document.createElement('option');
        option.value = val;
        option.title = txt;
        option.appendChild(document.createTextNode(txt));
        combo.appendChild(option);
    }
</script>
</head>
<body style="padding-top:2%;font-family:Tahoma, Times, serif;font-weight:bold;" onload="fill_Date_Combo();">


<div class="container" style="padding-top:5px;">
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
		<div class="row">
		
			<div  class="col-sm-2 col-md-2 col-lg-2"  >
				<!-- display user details like passport ..name.. ID ..Class type -->
			</div>
				<div  class="col-sm-8 col-md-8 col-lg-8">
					<div  class="col-lg-12" style="width:100%; padding-top:5px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						<h3 style="text-align:center;color:white">The Profiler - Print Reports</h3>
						<h5 style="text-align:center;color:yellow">Welcome	-	Administrator <?php echo $_SESSION['Admin_user_full_name'];?> - <a style="color:white" href="../exam_logout.php">Log Out</a> | <a style="color:white" href="Admin_Home.php">Admin Home</a></h5>
					</div>
					<div  class="col-sm-12 col-md-12 col-lg-12"  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:0px; padding-bottom:5px; background-color:CadetBlue;margin-bottom:1%;color:yellow">
				
							<h4>&darr; Print Reports On (Products / Articles) &darr;  Date Format : MM / DD / YYYY</h4>
						<hr/>
						
						<div class="col-xs-10 col-sm-10" style="//display: none;" >
						<form role="form"  name="reg_form"  id="form" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
							<div class="form-group">
									<label for="type" class="control-label col-xs-3">Goods/Articles :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-5">
										
											<select class="form-control"  id="type"  name="type">
													<option value="P">Properties</option>
													<option value="A">Articles</option>
											</select>
									
									</div> 
							</div> 
							<div class="form-group">
									<label for="f_day" class="control-label col-xs-3">Date From :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-2">
										
											<select class="form-control"  id="f_day"  name="f_day">
													
											</select>
									
									</div> 
									<div class="col-xs-3">
										
											<select class="form-control"  id="f_month"  name="f_month">
													
											</select>
									
									</div> 
									<div class="col-xs-4">
										
											<select class="form-control"  id="f_year"  name="f_year">
													
											</select>
									
									</div>
							</div>
							<div class="form-group">
									<label for="t_day" class="control-label col-xs-3">Date To :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-2">
										
											<select class="form-control"  id="t_day"  name="t_day">
													
											</select>
									
									</div>
									<div class="col-xs-3">
										
											<select class="form-control"  id="t_month"  name="t_month">
													
											</select>
									
									</div>
									<div class="col-xs-4">
										
											<select class="form-control"  id="t_year"  name="t_year">
													
											</select>
									
									</div>
							</div>
						
								
							<br/>
						<div  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:5px; padding-bottom:0px; background-color:grey;margin-bottom:1%">
						<div class="form-group">
									<label for="" class="control-label col-xs-8"><?php echo $err;?></label>
									<div class="col-xs-4">
										<div class="input-group">
												<input  type="Submit"  class="submit_btn btn btn-success"  style="width:100%;" value="Search And Download" name="Submit_odas"  ></input>
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
