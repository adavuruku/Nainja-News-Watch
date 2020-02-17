
<?php
session_start(); 
require_once '../settings/connection.php';
require_once '../settings/filter.php';
$a_name=$a_category=$a_title=$a_description=$goods_id =$folder_name=$err = "";
if(!isset($_SESSION['Admin_user_name']) AND !isset($_SESSION['Admin_user_full_name']))
{
	header("location: exam_logout.php");
}
function water_mark_image($moveto2,$ext)
{
		$watermark = imagecreatefrompng('../store_files/images/fpi_file.png');
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
function verify_existence($type_2,$search_id){
global $conn;
	$stmt = $conn->prepare("SELECT * FROM store_articles WHERE article_id=? AND type=?");		
	$stmt->execute(array($search_id,$type_2));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1){
		return "0".$search_id;
	}else{
		return $search_id;
	}
}
if($_SERVER['REQUEST_METHOD'] == "POST")
{  
		$a_description =$_POST['a_description'];
		$a_description = trim($_POST['a_description']);
		$a_description = htmlentities($a_description);
		
		$a_name=$_POST['a_name'];
		$a_title=$_POST['a_title'];
		$a_category=$_POST['a_category'];
		
	//check for empty
	if($a_description!="" && $a_name!="" && $a_title!="")
	{
		//save Records
		//create a folder to save files
		$folder_name = rand() * time();
		$folder_name = verify_existence($a_category,$folder_name);
		
		$goods_id = $fPath = "../store_files/Other_Files/".$folder_name;
		mkdir($goods_id,0777);
		
		if($_FILES['photo_one']['name']!="")
		{
			//$err = '<p style="color:red">one</p>';
			$tmpName  = $_FILES['photo_one']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_one']['name'], "."), 1);
			$newpath= "news_file".".$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			
			$wmax = 1100;
			$hmax = 400;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}		
		
		//insert record to Database
		$status="0";
		$sth = $conn->prepare ("INSERT INTO store_articles (article_title, article_id, author, status, Description, type,date_register)
														VALUES (?,?,?,?,?,?,now())");															
					$sth->bindValue (1, $a_title);    
					$sth->bindValue (2, $folder_name);
					$sth->bindValue (3, $a_name);
					$sth->bindValue (4, $status);					
					$sth->bindValue (5, $a_description);
					$sth->bindValue (6, $a_category);
					
					/*$g_description = trim($_POST['g_description']);
					//$mail_address = strip_tags(trim($_POST['receiver']));
					$g_description = htmlentities($g_description);*/
					
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
 <script type="text/javascript" src="../CK EDITOR/ckeditor.js"></script>
</head>
<body style="padding-top:2%;font-family:Tahoma, Times, serif;font-weight:bold;">


<div class="container" style="padding-top:5px;">
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
		<div class="row">
		
			<div  class="col-sm-1 col-md-1 col-lg-1"  >
				<!-- display user details like passport ..name.. ID ..Class type -->
			</div>
				<div  class="col-sm-10 col-md-10 col-lg-10">
					<div  class="col-lg-12" style="width:100%; padding-top:5px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						<h3 style="text-align:center;color:white">Upload Other Resource</h3>
						<h5 style="text-align:center;color:yellow">Welcome	-	Administrator <?php echo $_SESSION['Admin_user_full_name'];?> - <a style="color:white" href="../exam_logout.php">Log Out</a> | <a style="color:white" href="Admin_Home.php">Admin Home</a></h5>
					</div>
					<div  class="col-sm-12 col-md-12 col-lg-12"  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:0px; padding-bottom:5px; background-color:CadetBlue;margin-bottom:1%;color:yellow">
				
							<h4>&darr; Upload New Other Resource &darr;</h4>
							<?php echo $err;?>
						<hr/>
						
						<div class="col-xs-10 col-sm-10" style="//display: none;" >
						<form role="form"  name="reg_form"  id="form" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
							<div class="form-group">
									<label for="g_category" class="control-label col-xs-3">Category :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-5">
										
											<select class="form-control"  id="a_category" value="<?php echo $a_category; ?>" name="a_category">
													<option value="Event">Event</option>
													<option value="Profile" >Pesornality Profile</option>
													<option value="Documentation" >Documents</option>
											</select>
									
									</div>
							</div>
							
							<div class="form-group">
									<label for="g_name" class="control-label col-xs-3">Author :<span style="color:red" class"require">*</span></label>
										<div class="col-xs-9">
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
													<input  type="text"  class="text_field form-control"  id="a_name" name="a_name" value="<?php echo $a_name; ?>" placeholder="Enter The Author Name"> </input>
											</div>
										</div>
							</div>
							<div class="form-group">
									<label for="g_name" class="control-label col-xs-3">Title :<span style="color:red" class"require">*</span></label>
										<div class="col-xs-9">
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
													<textarea rows="3" type="text"  class="text_field form-control"  id="a_title" name="a_title" value="<?php echo $a_title; ?>" placeholder="Enter News Title"> </textarea>
											</div>
										</div>
							</div>
							<div class="form-group">
									<label for="photo_one" class="control-label col-xs-3">Upload Pics :</label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_one" value="browse" name="photo_one"  ></input>
											</div>
									</div>									
							</div>
						<div class="form-group">
									<label for="g_description" class="control-label col-xs-3">Details :<span style="color:red"class"require">*</span></label>
									<div class="col-xs-9">
										
											<textarea  rows="5" class="form-control"  id="a_description" name="a_description" value="">
													
													<?php echo $a_description;?>
											</textarea>
											
											 <script>
												CKEDITOR.replace( 'a_description' );											
											</script>
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
				
				<div  class="col-sm-1 col-md-1 col-lg-1"></div>
				
				<div class="clearfix visible-sm-block"></div>
				<div class="clearfix visible-md-block"></div>
				<div class="clearfix visible-lg-block"></div>
		</div>
		<!-- middle content ends here where vertical nav slides and news ticker ends -->
	
		<div class="row">
			<div class="col-xs-2 col-sm-2"></div>	
				<div class="col-xs-8 col-sm-8" >
					<footer>
						<p style="text-align:center">Copyright &copy; 2015 - All Rights Reserved - Software Development Unit, A S A.</p>
					</footer>
				</div>
			<div class="col-xs-2 col-sm-2"></div>	
		</div>	
</div>	
</body>
</html>  
