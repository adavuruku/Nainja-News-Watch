
<?php
session_start(); 
require_once '../settings/connection.php';
require_once '../settings/filter.php';
$g_price =$g_subcategory=$g_category=$g_description =$g_name=$goods_id =$folder_name=$err = "";
if(!isset($_SESSION['Admin_user_name']) AND !isset($_SESSION['Admin_user_full_name']))
{
	header("location: exam_logout.php");
}
function water_mark_image($moveto2,$ext)
{
		$watermark = imagecreatefrompng('../store_files/images/fpiputme.png');
		$watermark_widht = imagesx($watermark);
		$watermark_height =imagesy($watermark);
		$image =imagecreatetruecolor ($watermark_widht, $watermark_height);
		$image = imagecreatefromjpeg($moveto2);
		$image_size = getimagesize($moveto2);
		$x = $image_size[0] - $watermark_widht - 20;
		$y = $image_size[1] - $watermark_height - 20;
		imagecopymerge($image, $watermark, $x, $y, 0, 0, $watermark_widht, $watermark_height, 50);
		//this saves it to its destination folder
		imagejpeg ($image,$moveto2);
}
function ak_img_resize($target, $newcopy, $w, $h, $ext) 
{
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 80);
	water_mark_image($target,$ext);
}
function verify_existence($search_id){
global $conn;
	$stmt = $conn->prepare("SELECT * FROM store_goods WHERE product_id=?");		
	$stmt->execute(array($search_id));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1){
		return "Exist";
	}else{
		return "Not Exist";
	}
	
}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_FILES['photo_one']['name']!="")
{ 
		$g_price = $_POST['g_price'];
		//$g_subcategory=$_POST['g_subcategory'];
		$g_category=$_POST['g_category'];
		$g_description =$_POST['g_description'];
		$g_name=$_POST['g_name'];
		
	//check for empty
	if($g_price!="" && $g_subcategory!="" && $g_category!="" && $g_description!="" && $g_name!="" && $g_price > 0)
	{
		//save Records
		//create a folder to save files
		$folder_name = md5(rand() * time());
		$out_come = verify_existence($folder_name);
		if($out_come == "Exist"){
			$folder_name = md5(rand() * time());
			$out_come = verify_existence($folder_name);
		}
		$goods_id = $fPath = "../store_files/properties/".$folder_name;
		mkdir($goods_id,0777);
		
		if($_FILES['photo_one']['name']!="")
		{
			//$err = '<p style="color:red">one</p>';
			$tmpName  = $_FILES['photo_one']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_one']['name'], "."), 1);
			$newpath= "1_file".".$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			
			$wmax = 400;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}		
		if($_FILES['photo_two']['name']!="")
		{
			//$err = '<p style="color:red">two</p>';
			$tmpName  = $_FILES['photo_two']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_two']['name'], "."), 1);
			$newpath= "2_file".".$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			
			$wmax = 400;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}
		
		if($_FILES['photo_three']['tmp_name']!="")
		{
			//$err = '<p style="color:red">three</p>';
			$tmpName  = $_FILES['photo_three']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_three']['name'], "."), 1);
			$newpath= "3_file".".$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			$wmax = 400;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}
		if($_FILES['photo_four']['name']!="")
		{
			//$err = '<p style="color:red">Error :four</p>';
			$tmpName  = $_FILES['photo_four']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_four']['name'], "."), 1);
			$newpath= "4_file."."$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			
			$wmax = 400;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}
		
		//insert record to Database
		$sth = $conn->prepare ("INSERT INTO store_goods (product_id, product_name, category, price,details, date_register)
														VALUES (?,?,?,?,?,now())");															
					$sth->bindValue (1, $folder_name); 
					$sth->bindValue (2, $g_name); 
					$sth->bindValue (3, $g_category); 
					$sth->bindValue (4, $g_price); 
					//$sth->bindValue (5, $g_subcategory); 
					$sth->bindValue (6, $g_description);
				
					if($sth->execute()){
						$err = '<p style="color:white"> Record Saved - Successfully</p>';
					}
					//$affected_rows = $sth->rowCount();
	}
	else
	{
		$err = '<p style="color:red">Error :Some Fields are Empty</p>';
	}
}	

if(isset($_SESSION['u_name']) AND isset($_SESSION['outcome']))
{
	unset($_SESSION['u_name']);
	unset($_SESSION['outcome']);
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

function noNumbers(e, t) 
{
            try {

                if (window.event) {
                    var charCode = window.event.keyCode;}

                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }

                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
            catch (err) {
                alert(err.Description);
            }   
} 

</script>

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
						<h3 style="text-align:center;color:white">The Profile - Upload New Goods</h3>
						<h5 style="text-align:center;color:yellow">Welcome	-	Administrator <?php echo $_SESSION['Admin_user_full_name'];?> - <a style="color:white" href="../exam_logout.php">Log Out</a> | <a style="color:white" href="Admin_Home.php">Admin Home</a></h5>
					</div>
					<div  class="col-sm-12 col-md-12 col-lg-12"  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:0px; padding-bottom:5px; background-color:CadetBlue;margin-bottom:1%;color:yellow">
				
							<h4>&darr; Register New Goods (Products) &darr;</h4>
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
							<div class="form-group">
									<label for="g_description" class="control-label col-xs-3">Description :<span style="color:red" class"require">*</span></label>
										<div class="col-xs-9">
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
													<textarea    class="form-control"  id="g_description" name="g_description" value="<?php echo $g_description; ?>" placeholder="Enter Goods Descriptions"></textarea>
											</div>
										</div>
								</div>
							<div class="form-group">
									<label for="g_category" class="control-label col-xs-3">Category :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-5">
										
											<select class="form-control"  id="g_category" value="<?php echo $g_category; ?>" name="g_category">
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
													<input type="text"  class="text_field form-control" onkeydown="return noNumbers(event,this)" value="<?php echo $g_price; ?>" id="g_price" name="g_price" value="" placeholder="Enter Price" >
											</div>
									
									</div>									
								</div>
							<div class="form-group">
									<label for="photo_one" class="control-label col-xs-3"></label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_one" value="browse" name="photo_one"  ></input>
											</div>
									</div>									
							</div>
							
							
							<div class="form-group">
									<label for="photo_two" class="control-label col-xs-3"></label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_two" value="browse" name="photo_two"  ></input>
											</div>
									</div>									
							</div>

								<div class="form-group">
									<label for="photo_three" class="control-label col-xs-3"></label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_three" value="browse" name="photo_three"  ></input>
											</div>
									</div>									
							</div>
							<div class="form-group">
									<label for="photo_four" class="control-label col-xs-3"></label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_four" value="browse" name="photo_four"  ></input>
											</div>
									</div>									
							</div>
							<br/>
						<div  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:5px; padding-bottom:0px; background-color:grey;margin-bottom:1%">
						<div class="form-group">
									<label for="" class="control-label col-xs-9"><?php echo $err;?></label>
									<div class="col-xs-3">
										<div class="input-group">
												<input  type="Submit"  class="submit_btn btn btn-success"  style="width:100%;" value="Save New Record" name="Submit_odas"  ></input>
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
