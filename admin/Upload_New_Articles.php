
<?php
session_start(); 
require_once '../settings/connection.php';
require_once '../settings/filter.php';
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
require_once __DIR__ . '/facebook-sdk-v5/autoload.php';
$a_price =$a_description=$a_title=$a_category =$a_name=$goods_id =$folder_name=$err = "";
$a_name = $_SESSION['Admin_user_full_name'];
if(!isset($_SESSION['Admin_user_name']) AND !isset($_SESSION['Admin_user_full_name']))
{
	header("location: ../exam_logout.php");
}
//post to facebook

	$fb = new Facebook\Facebook([
	  'app_id' => '630641980453868',
	  'app_secret' => '4ceef71cfac1bba3bf2c1442087795c3',
	  'default_graph_version' => 'v2.5',
	]);
function water_mark_image($moveto2,$ext)
{
		$watermark = imagecreatefrompng('../settings/images/fpiputme.png');
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
	$stmt = $conn->prepare("SELECT * FROM news WHERE news_id=?");		
	$stmt->execute(array($search_id));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1){
		return "0".$search_id;
	}else{
		return $search_id;
	}
	
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{      
		$a_price =$_POST['a_price'];
		$pos ="";
		$a_description = trim($_POST['a_description']);
		$a_description = htmlentities($a_description);
		
		$a_title=$_POST['a_title'];
		$a_category = $_POST['a_category'];
		//$a_name = $_POST['a_name'];
		if($a_category=="Politics"){
			$pos ="1";
		}
		if($a_category=="Articles"){
			$pos ="2";
		}
		if($a_category=="Features / Interview"){
			$pos ="3";
		}
		if($a_category=="Sports"){
			$pos ="4";
		}
		if($a_category=="Entertainment"){
			$pos ="5";
		}
		if($a_category=="Business"){
			$pos ="6";
		}
		if($a_category=="Metro"){
			$pos ="7";
		}
		if($a_category=="Tech"){
			$pos ="8";
		}
		if($a_category=="Health"){
			$pos ="9";
		}
		if($a_category=="Relationship"){
			$pos ="10";
		}
		if($a_description==""){
			$a_description = "Nainja News Watch View [PHOTOS]";
		}
		
	//check for empty
	if($a_description!="" && $a_title!="" && $a_category!="")
	{
		//save Records
		//create a folder to save files
		$folder_name = rand() * time();
		$folder_name = verify_existence($folder_name);
		
		$goods_id = $fPath = "../resourcefile/News_Files/".$folder_name;
		mkdir($goods_id,0777);
		
		if($_FILES['photo_one']['name']!="")
		{
			//$err = '<p style="color:red">one</p>';
			$tmpName  = $_FILES['photo_one']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_one']['name'], "."), 1);
			$newpath= "news_file".".$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			
			$wmax = 900;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}	
		
		
		if($_FILES['photo_two']['name']!="")
		{
			//$err = '<p style="color:red">two</p>';
			$tmpName  = $_FILES['photo_two']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_two']['name'], "."), 1);
			$newpath= "file_1".".$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			
			$wmax = 900;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}
		
		if($_FILES['photo_three']['tmp_name']!="")
		{
			//$err = '<p style="color:red">three</p>';
			$tmpName  = $_FILES['photo_three']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_three']['name'], "."), 1);
			$newpath= "file_2".".$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			$wmax = 900;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}
		if($_FILES['photo_four']['name']!="")
		{
			//$err = '<p style="color:red">Error :four</p>';
			$tmpName  = $_FILES['photo_four']['tmp_name'];
			$extension = substr(strrchr($_FILES['photo_four']['name'], "."), 1);
			$newpath= "file_3."."$extension";
			$moveto= $goods_id."/".$newpath;
			move_uploaded_file($tmpName,$moveto);
			
			$wmax = 900;
			$hmax = 300;
			ak_img_resize($moveto, $moveto, $wmax, $hmax, $extension);
		}

		$status ="0";
		$type ="Ebook";
		//insert record to Database
		//credited - aticle author 
		//author - the journalist that loged in.
		$sth = $conn->prepare ("INSERT INTO news (news_head, news_info, news_id,news_type,credited,priority,no_read,author,category,facebk_id,status,no_comment,no_like,news_date)
														VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,now())");																
					$sth->bindValue (1, $a_title);
					$sth->bindValue (2, $a_description);
					$sth->bindValue (3, $folder_name);
					$sth->bindValue (4, $a_category);
					$sth->bindValue (5, $a_price); 
					$sth->bindValue (6, $pos);
					$sth->bindValue (7, $status);
					$sth->bindValue (8, $_SESSION['Admin_user_full_name']);
					$sth->bindValue (9, $a_category);
					$sth->bindValue (10, $status);
					$sth->bindValue (11, $status);
					$sth->bindValue (12, $status);
					$sth->bindValue (13, $status);
					if($sth->execute()){
						$err = '<p style="color:white"> Record Saved - Successfully</p>';
						//display news in facebook
							if(isset($_SESSION['facebook_access_token']))
							{
								$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
								//post to the user facebook wall
								$lin ='<a href="http://localhost/NainjaNewsWatch/read_information_details.php?news_id="'.$folder_name.'">click to read</a>';
								
								$subj_two = substr($a_description,0,300)."...".'<br /><p>'.$lin.'</p>';
								$body_two = htmlspecialchars_decode($subj_two);
								$body_two= str_ireplace('<p>','',$body_two);
								$body_two= strip_tags($body_two);
								$msg = $body_two;
								
								//pics with the title
								$image_line = strip_tags($folder_name);
								$iteratepoint = '../resourcefile/News_Files/'.$image_line.'/';
								$dir = new DirectoryIterator($iteratepoint);
								$image_file=$picky='';
								foreach ($dir as $fileinfo) 
								{
									if (!$fileinfo->isDot()) 
									{
										$picky = $fileinfo->getFilename();
										if(substr_count($picky,"news_file") > 0){
											$image_file =$picky;
										}
									}		
								}
								//$pic = 'http://localhost/NainjaNewsWatch/resourcefile/News_Files/'.$folder_name.'/'.$image_file;
								$pic = 'http://ninjanewswatch.comze.com/resourcefile/News_Files/48639347419455/news_file.jpg';
								//$pic = 'http://media.premiumtimesng.com/wp-content/files/2015/12/Mike-Ozekhome.jpg';
								
								//description with the title
								$des =$body_two;
								//title
								$na = $a_title;
								$cap = 'www.NainjaNewsWatch.com';
								$linkData = [
												'link' => $lin,	  
												'message' => $msg,
												'picture' => $pic,
												'name' => $na,
												'caption' => $cap,
												'description' => $des,
								  ];
								  try {
										$response = $fb->post('/me/feed', $linkData, $_SESSION['facebook_access_token']);
										$graphNode = $response->getGraphNode();
										//echo 'Posted with id: ' . $graphNode['id'];
										//save the id of the post to get comments or use the post
										$post_id = $graphNode['id'];
										//update the db record
										$stmt = $conn->prepare("UPDATE news SET facebk_id= ? WHERE news_id=?");
										$stmt->execute(array($post_id,$folder_name));
										
										} catch(Facebook\Exceptions\FacebookResponseException $e) {
										  echo 'Graph returned an error: ' . $e->getMessage();
										  exit;
										} catch(Facebook\Exceptions\FacebookSDKException $e) {
										  echo 'Facebook SDK returned an error: ' . $e->getMessage();
										  exit;
										}
							}
						
						////display news in facebook end
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
<title>Nainja News Watch  </title>
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
 <script type="text/javascript" src="../CK EDITOR/ckeditor.js"></script>
</head>
<body style="padding-top:2%;font-family:Tahoma, Times, serif;font-weight:bold;">


<div class="container" style="padding-top:5px;">
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
		<div class="row">
		
			
				<div  class="col-sm-12 col-md-12 col-lg-12">
					<div  class="col-lg-12" style="width:100%; padding-top:5px; padding-left:5px; padding-bottom:10px; background-color:grey;margin-bottom:1%">
						<h3 style="text-align:center;color:white">Nainja News Watch | Home Site</h3>
						<h5 style="text-align:center;color:yellow">Welcome	-	Administrator <?php echo $_SESSION['Admin_user_full_name'];?> - <a style="color:white" href="../exam_logout.php">Log Out</a> | <a style="color:white" href="Admin_Home.php">Admin Home</a></h5>
					</div>
					<div  class="col-sm-12 col-md-12 col-lg-12"  class="col-lg-12" style="width:100%; padding-top:10px; padding-left:0px; padding-bottom:5px; background-color:CadetBlue;margin-bottom:1%;color:yellow">
				
							<h4>&darr; Upload New Articles &darr;</h4>
							<?php echo $err;?>
						<hr/>
						
						<div class="col-xs-10 col-sm-10" style="//display: none;" >
						<form role="form"  name="reg_form"  id="form" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
							<div class="form-group">
									<label for="a_title" class="control-label col-xs-3">Head Line :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-5">
											<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
													<textarea    class="form-control"  id="a_title" name="a_title" value="<?php echo $a_title; ?>" placeholder="Enter News Title"></textarea>
											</div>
										</div>									
								</div> 
								
							
							<div class="form-group">
									<label for="a_category" class="control-label col-xs-3">Category :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-5">
										
											<select class="form-control"  id="a_category" value="<?php echo $a_category; ?>" name="a_category">
													<option value="Politics">Politics</option>
													<option value="Articles">Articles</option>
													<option value="Features / Interview">Features / Interview</option>
													<option value="Sports">Sports</option>
													<option value="Entertainment">Entertainment</option>
													<option value="Business">Business</option>
													<option value="Metro">Metro</option>
													<option value="Tech">Tech</option>
													<option value="Health">Health</option>
													<option value="Relationship">Relationship</option>
											</select>
									
									</div>
							</div>
							
							<div class="form-group">
									<label for="a_price" class="control-label col-xs-3">Articles Author : </label>
									<div class="col-xs-5">
										<div class="input-group">
												<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
													<input type="text"  class="text_field form-control" value="<?php echo $a_price; ?>" id="a_price" name="a_price"  value="" placeholder="Enter News Platfom you copied the News" >
											</div>
									</div>									
								</div>
							<div class="form-group">
									<label for="photo_one" class="control-label col-xs-3">Main Pics :<span style="color:red;padding:0px"class"require">*</span></label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_one" value="browse" name="photo_one"  ></input>
											</div>
									</div>									
							</div>
							<div class="form-group">
									<label for="photo_one" class="control-label col-xs-3">Second Pics :</label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_two" value="browse" name="photo_two"  ></input>
											</div>
									</div>									
							</div>
							<div class="form-group">
									<label for="photo_one" class="control-label col-xs-3">Third Pics :</label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_three" value="browse" name="photo_three"  ></input>
											</div>
									</div>									
							</div>
							<div class="form-group">
									<label for="photo_one" class="control-label col-xs-3">Fourth Pics :</label>
									<div class="col-xs-9">
										<div class="input-group">
												<input  type="file"   id="photo_four" value="browse" name="photo_four"  ></input>
											</div>
									</div>									
							</div>
						<div class="form-group">
									<label for="a_description" class="control-label col-xs-3">Description :<span style="color:red"class"require">*</span></label>
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
												<input  type="Submit"  class="submit_btn btn btn-success"  style="width:100%;" value="Save Articles" name="Submit_odas"  ></input>
										</div>
									</div>									
							</div>
						</div>
						</form>
					
							
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
						<p style="text-align:center">Copyright &copy; 2017 - All Rights Reserved - Software Development Unit, A S A.</p>
					</footer>
				</div>
			<div class="col-xs-2 col-sm-2"></div>	
		</div>	
</div>	
</body>
</html>  
