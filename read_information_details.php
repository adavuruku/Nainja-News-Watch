<?php 
session_start(); 
require_once 'settings/connection.php';
require_once 'settings/filter.php';
//retrieve the news details


	$title_here=$body_here=$date_here=$category=$by=$credited=$id_news=$view =$likes=$com=$txtName=$txtEmail=$a_description=$err="";
	if(isset($_GET['news_id'])){
		$search = strip_tags($_GET['news_id']);
	}
	
	function verify_existence($search_id){
	global $conn;
		$stmt = $conn->prepare("SELECT * FROM news WHERE news_id=?");		
		$stmt->execute(array($search_id));
		$affected_rows = $stmt->rowCount();
		if($affected_rows >= 1){
			return "C".$search_id;
		}else{
			return $search_id;
		}
	}
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if(isset($_POST['news_id'])){
			$search = strip_tags($_POST['news_id']);
		}

		$txtEmail = filterEmail($_POST['txtEmail']);
		$txtName = checkempty($_POST['txtName']);
		$txtName_2 = filterName($_POST['txtName']);
		$a_description = checkempty($_POST['a_description']);

		if(($txtEmail != False) && ($txtName != False) && ($txtName_2 != False) && ($a_description != False)){
			
			$txtEmail = $_POST['txtEmail'];
			$txtName = $_POST['txtName'];
			$a_description = trim($_POST['a_description']);
			$a_description = htmlentities($a_description);

			$folder_name = rand() * time();
			$folder_name = verify_existence($folder_name);

			//create new comment
			$status="0";
			$sth = $conn->prepare ("INSERT INTO news_comment (email,post_name,news_id,comment,comment_id,like_post,reply,date_post)
														VALUES (?,?,?,?,?,?,?,now())");																
					$sth->bindValue (1, $txtEmail);
					$sth->bindValue (2, $txtName);
					$sth->bindValue (3, $search);
					$sth->bindValue (4, $a_description);
					$sth->bindValue (5, $folder_name);
					$sth->bindValue (6, $status);
					$sth->bindValue (7, $status);
					if($sth->execute()){
						$stmt = $conn->prepare("UPDATE news SET no_comment = no_comment + 1 WHERE news_id=? Limit 1");
						$stmt->execute(array($search));
					}

		}else{
			$err = '<p style="color:red">Fail to Post Comment Invalid Information Provided </p>';
		}

		
		
	}
	//count number of time viewed
	if(isset($_COOKIE['view']))
	{
		if($_COOKIE['view'] <> $search)
		{
			//upadte the number of time visited
			$stmt = $conn->prepare("UPDATE news SET no_read = no_read + 1 WHERE news_id =? Limit 1");
			$stmt->execute(array($search));
			setcookie("view", $search, strtotime( '+5 days' ), "/", "", "", TRUE);
		}
	}else{
		setcookie("view", $search, strtotime( '+5 days' ), "/", "", "", TRUE);
		$stmt = $conn->prepare("UPDATE news SET no_read =no_read + 1 WHERE news_id =? Limit 1");
		$stmt->execute(array($search));
	}
	
	$stmt = $conn->prepare("SELECT * FROM news where news_id=? Limit 1");
	$stmt->execute(array($search));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1) 
	{	
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//$title ="<p style='color:yellow'>".$row['news_head']."</p>";
			$title_here =$row['news_head'];
			$id_news=$row['id'];
			$date500_two = new DateTime($row['news_date']);
				$J = date_format($date500_two,"l");
				$Q = date_format($date500_two,"d F, Y  h:i:s A");
				$dateprint = $J.", ".$Q;
			$likes= $row['no_like'];
			$com= $row['no_comment'];
			$date_here = $dateprint;
			$body_here =htmlspecialchars_decode($row['news_info']);
			$category=$row['category'];
			$by =$row['author'];
			$credited = $row['credited'];
			$view = $row['no_read'];
	}else{
	
		//displY THE LAST UPDATED NEWS
		$stmt = $conn->prepare("SELECT * FROM news order by id desc Limit 1");
		$stmt->execute();
		$affected_rows = $stmt->rowCount();
		if($affected_rows >= 1) 
		{	
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
				//$title ="<p style='color:yellow'>".$row['news_head']."</p>";
				$title_here =$row['news_head'];
				$search=$row['news_id'];
				$id_news=$row['id'];
				$date500_two = new DateTime($row['news_date']);
				$J = date_format($date500_two,"l");
				$Q = date_format($date500_two,"d F, Y  h:i:s A");
				$dateprint = $J.", ".$Q;
				$likes= $row['no_like'];
				$com= $row['no_comment'];
				$date_here = $dateprint;
				$body_here =htmlspecialchars_decode($row['news_info']);
				$category=$row['category'];
				$by =$row['author'];
				$credited = $row['credited'];
				$view = $row['no_read'];
		}
	}
	
	//format the body
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Nainja News Watch  </title>
<link rel="shortcut icon" href="settings/images/nainja.jpg">

<meta property="og:locale" content="en_GB"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="How to Auto Post on Facebook with PHP"/>
<meta property="og:description" content="The lawyer wants the court to unfreeze his account."/>
<meta property="og:url" content="http://localhost/NainjaNewsWatch/read_information_details.php?news_id=27242360597947"/>
<meta property="og:site_name" content="Nainja News Watch"/>
<meta property="article:author" content="www.facebook.com/premiumtimes"/>
<meta property="og:image" content="http://localhost/NainjaNewsWatch/resourcefile/News_Files/27242360597947/news_file.jpg"/>
<meta property="og:image:width" content="600"/>
<meta property="og:image:height" content="368"/>


<link rel="stylesheet" type="text/css" href="settings/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap-theme.css" >
<script type="text/javascript" src="settings/js/bootstrap.js"></script>
<script type="text/javascript" src="settings/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="settings/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="settings/js/bootstrap.min.js"></script>
<script type="text/javascript" src="settings/edit_goods.js"></script>
<script type="text/javascript" src="CK EDITOR/ckeditor.js"></script>
<style>

</style>
<?php //require_once 'settings/my_news_form.php';?>
</head>
<body style="background-color:#eeeeee;">
<div class="container-fluid">
<?php require_once 'settings/header_file.php';?>
	<!-- c -->
	<div class="row" style="background-color:white;">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;">
			<h5 style="border-bottom-right-radius:2em;border-top-right-radius:2em;background:#dddddd;padding: 10px 0px 10px 10px;color:red;"><b>Home &raquo; <?php echo $category;?> &raquo; <span style="color:blue;"><?php echo $title_here;?></span></b></h5>
			<hr/>
		</div>
	</div><!-- ends row title -->
		
	<div  class="row"><!-- cont row news -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;"><!-- host news -->
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="background-color:white;"><!-- box 8 begin here -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;"><!-- news detail heading  -->
					<h3 style="color:black;font-weight:bold;font-name:Serif;"><span style="color:red;font-family:Due;"><?php echo $category;?> News : </span><?php echo $title_here;?></h3>
					<?php
						if($credited !=""){
							echo '<p style="color:black;font-weight:bold;font-family:Due;">By : '.$credited.'</p>';
						}
						if($by !=""){
							$path_two="view_more_author_post.php?news_c=".$by;
							echo "<p style='color:black;font-weight:bold;font-name:tahoma;' >Edited By : ".$by." | 
							<a style='color:red;font-weight:bold;font-name:tahoma;' href='".$path_two."'>View More News From ".$by."</a></p>";
						}
						
						
					?>
					<p style="color:red;font-weight:bold;font-name:tahoma;"><?php echo $date_here;?></p>
					<p style="color:black;font-weight:bold;font-name:tahoma;">Visitors have accessed this post - <span style="color:red;"> <?php echo $view;?></span> - times. </p>
				</div><!-- news detail heading ends  -->
				<div  class=" col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:15px;background-color:white;"><!-- info pics -->
					<?php 
						$image_line = strip_tags($search);
						$number = 0;$my_1=$my_3=$my_2='';
						$the_file_3="";
						$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
						$dir = new DirectoryIterator($iteratepoint);
						$the_file_3 ='';
						foreach ($dir as $fileinfo) 
						{
							if (!$fileinfo->isDot()) 
							{
								$picky = $fileinfo->getFilename();
								if(substr_count($picky,"news_file") > 0){
									$the_file = $picky;
									echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;">
									<img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$search.'/'.$the_file.'" /></div>';
									
								}else{
									$number = $number + 1;
									if($number==1){
										$my_1 = '<img  style="margin:15px 15px 15px 0px;" class="img-responsive img-thumbnail pull-left" src="resourcefile/News_Files/'.$search.'/'.$picky.'" />';
									}
									if($number==2){
										$my_2 = '<img  style="margin:15px 15px 15px 0px;" class="img-responsive img-thumbnail pull-left" src="resourcefile/News_Files/'.$search.'/'.$picky.'" />';
									}
									if($number==3){
										$my_3 = '<img  style="margin:15px 15px 15px 0px;" class="img-responsive img-thumbnail pull-left" src="resourcefile/News_Files/'.$search.'/'.$picky.'" />';
									}
								}
								
							}
						}
						
						
					?>
				</div><!-- info pics -->
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="font-family:Times New Roman, Times, serif, arial; font-size:15px; padding-bottom:35px;background-color:white;text-align:justify;font-style:Tahoma;"><!-- info datas -->			
					<?php 
						//echo $body_here.$number;
						if($category=="Videos"){
							$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
							$dir = new DirectoryIterator($iteratepoint);
							$the_file_3 ='';
							foreach ($dir as $fileinfo) 
							{
								if (!$fileinfo->isDot()) 
								{
									$picky = $fileinfo->getFilename();
									if(substr_count($picky,"news_file") <= 0){
										echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
										<video width="100%" controls="controls" poster="resourcefile/News_Files/29975772415924/news_file.jpg"  >
											<source src="resourcefile/News_Files/'.$image_line."/".$picky.'" type="video/mp4">
												<source src="resourcefile/News_Files/'.$image_line."/".$picky.'" type="video/ogg">
												<source src="resourcefile/News_Files/'.$image_line."/".$picky.'" type="video/webm">
												Your browser does not support these Videos.
										</video>
									</div>';
									}
								}
							}
						}else{

							$len_T = strlen($body_here);
							$last_L = ($len_T/($number+1));
							if($number==1){
								echo '<p>'.substr($body_here,0,$last_L).'</p>';
								echo $my_1;
								echo '<p>'.substr($body_here,$last_L,$len_T).'</p>';
							}
							elseif($number==2){
								echo htmlspecialchars_decode("<span>".substr($body_here,0,$last_L)."</span>");
								echo $my_1;
								echo "<span>".substr($body_here,$last_L,$last_L)."</span>";
								echo $my_2;
								echo "<span>".substr($body_here,($last_L*2),$len_T)."</span>";
								
							}elseif($number==3){
								echo substr($body_here,0,$last_L).$my_1.substr($body_here,$last_L,$last_L)
								.$my_2.substr($body_here,($last_L*2),$last_L).$my_3.substr($body_here,($last_L*3),$len_T);
							}else{
								echo $body_here;
							}
						}
					?>
				</div><!-- info datas ends -->
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom:20px;">
					<?php
						$id_link =" id=".'"'.$search.'"';
						echo '<h2 style="color:white;"><span style="cursor:pointer;" '.$id_link.' onclick="like_news_post(\''.$search.'\')" class="label label-primary likeme">'.$likes.' Likes </span> | 
						<span class="label label-primary">'.$com.' Comments </span> | <span class="label label-primary">'.$view.' Views </span></h2>';
					?>
				</div>
				<!--Previous and next begin here-->
				
			<div class="row"><!--Comments begins-->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#eeeeee;" >
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#eeeeee;color:white;margin-bottom:5px;margin-top:0px" >
								<hr />
									<?php 
										$my_file_two ="";
										$stmt_ina = $conn->prepare("SELECT * FROM news_comment where news_id =?");
										$stmt_ina->execute(array($search));
										$affected_rows_ina = $stmt_ina->rowCount();
										$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
										$total_count = $affected_rows_ina;
										//record per Page($per_page)	
										$per_page = 10;//26
										$total_pages = ceil($total_count/$per_page);
										$offset = ($current_page - 1) * $per_page;

										$previous_page = $current_page - 1;
										$next_page = $current_page + 1;
										$has_previous_page =  $previous_page >= 1 ? true : false;
										$has_next_page = $next_page <= $total_pages ? true : false;

										$stmt_in = $conn->prepare("SELECT * FROM news_comment where news_id =? ORDER BY id DESC Limit {$per_page} OFFSET {$offset} ");
										$stmt_in->execute(array($search));

										$affected_rows_in = $stmt_in->rowCount();
							
										if($affected_rows_in >= 1) 
										{
											while($row_two = $stmt_in->fetch(PDO::FETCH_ASSOC))
											{
														$date500_two = new DateTime($row_two['date_post']);
														$date_two = date_format($date500_two,'d F, Y  h:i:s A');
														$date_two_1 = '<h4 style="color:black;"><strong>'.$row_two['post_name'].'</strong>  |  
														<strong>'.$row_two['email'].'</strong> |   
														<strong>'.$date_two.'</strong></h4>';
														$date_two = $date_two_1;
														$subj_two = htmlspecialchars_decode($row_two['comment']);

														$body_here = '<p style="color:black;">'.$subj_two.'</p>';
														$date_two = $date_two.$body_here;
														$path_two="reply_comment.php?news_id=".$row_two['comment_id'];
														$id_link =" id=".'"'.$row_two['comment_id'].'"';
														$likes= $row_two['like_post'];
														$likes_js= $row_two['like_post'];
														if($likes>0){
															$likes = $likes." Likes";
														}else{
															$likes = "Like";
														}
														$reply =$row_two['reply'];
														if($reply>0){
															$reply = $reply." Replies";
														}else{
															$reply = "Reply";
														}

														$likes = '<h4 style="color:white;"><span style="cursor:pointer;" '.$id_link.' onclick="like_news_comment(\''.$row_two['comment_id'].'\')" class="label label-primary likeme">'.$likes.'</span>  | 
																		<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																		<span class="label label-primary">'.$reply.'</span></a></h4>';
														
														$my_file_two = $my_file_two.'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;color:black;margin-bottom:15px">
																					'.$date_two.$likes.'
																				</div>';
														//echo $my_file_two;
											}
										}


										if ($total_pages > 1)
										{
											echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
													<ul class="pagination" align="center">';
														//this is for previous record
														if ($has_previous_page)
														{
															echo '<li><a style="background-color:grey;color:white" href=read_information_details.php?page='.$previous_page.'&news_id='.$search.'>&laquo; View Previous Comments</a> </li>';
														}
													echo '</ul></div>';
										}

										echo $my_file_two;

										if ($total_pages > 1)
										{
											echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
													<ul class="pagination" align="center">';
													//this is for next record		
													if ($has_next_page)
													{
														echo '<li><a style="background-color:grey;color:white" href=read_information_details.php?page='.$next_page.'&news_id='.$search.'>View More Comments &raquo;</a></li> ';
													}
											echo '</ul></div>';
										}
									?>
							</div>	
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#eeeeee;">
						<hr />
						<h5>Post Your Comment</h5>
						<?php echo $err;?>
						<form role="form" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
						
							<input type="hidden" value="<?php echo $search; ?>" id="news_id" name="news_id" placeholder="Enter Email">
						    <div class="form-group">
						        <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $txtEmail; ?>" placeholder="Enter Email">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control" id="txtName" name="txtName" value="<?php echo $txtName; ?>" placeholder="Enter Name">
						    </div>
						    <div class="form-group">
						        <textarea  rows="3" class="form-control"  id="a_description" name="a_description" value="">
														
										<?php echo $a_description;?>
								</textarea>
						    </div>	
							 <script>
								CKEDITOR.replace( 'a_description', {
										toolbar: [
											// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
											[ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ],
											{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike','Subscript','Superscript', '-', 'Underline', 'RemoveFormat' ] },
												{ name: 'insert', items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar' ] },
												{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] }
										]
									});											
							</script>
							<button type="submit" class="btn btn-primary btn-lg btn-block pull-right">Post Comment</button>
						</form>
						<hr />
					</div>
				</div>
			</div><!--Comments Ends-->
			<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom:35px;margin-bottom:15px;background-color:white;text-align:justify;font-style:Tahoma">
							<hr/>
							<div  class="row">
							<?php
								$id_news_p=$id_news - 1;
								$stmt_in = $conn->prepare("SELECT * FROM news where id=? Limit 1");
								$stmt_in->execute(array($id_news_p));
							
								$affected_rows_in = $stmt_in->rowCount();
								if($affected_rows_in >= 1) 
								{	
									$row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC);
									$my_file_two =$the_file_3='';
									$image_line = strip_tags($row_two_in['news_id']);
									$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
									$dir = new DirectoryIterator($iteratepoint);
									foreach ($dir as $fileinfo) 
									{
										$date500_two = new DateTime($row_two_in['news_date']);
										//$J = date_format($date500_two,'l');
										$date_two = date_format($date500_two,'d F, Y  h:i:s A');
										$date_two = '<p style="color:red;">'.$date_two.'</p>';
										//$date_two = $J.', '.$Q;
										if($row_two_in['category'] =="Articles"){
											$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['author'].'</p>';
										}
										if (!$fileinfo->isDot()) 
										{
											$picky = $fileinfo->getFilename();
											if(substr_count($picky,"news_file") > 0){
												$date500_two = new DateTime($row_two_in['news_date']);
												$J = date_format($date500_two,'l');
												$Q = date_format($date500_two,'d F, Y  h:i:s A');
												$date_two = $J.', '.$Q;
												$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
												$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
												if($row_two_in['category'] =="Articles"){
													$date_two = $date_two.'<p style="color:black;"> By : '.$row_two_in['credited'].'</p>';
												}else{
													$date_two = $date_two. '<p style="color:black;"> Edited By : '.$row_two_in['author'].'</p>';
												}
												$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
												$the_file_3 ='<a style="color:red;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom:5px;margin-top:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																	<h5> << Previous Post </h5>
																	<hr/>
																	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" >
																		<img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																	</div>
																	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" >'
																		.$date_two.
																	'</div>
																</div>
															</a>';								
												}
											
										}
									}
									echo $the_file_3;
								}
								
							//next news
							$id_news_n=$id_news + 1;
								$stmt_in = $conn->prepare("SELECT * FROM news where id=? Limit 1");
								$stmt_in->execute(array($id_news_n));
							
								$affected_rows_in = $stmt_in->rowCount();
								if($affected_rows_in >= 1) 
								{	
									$row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC);
									$my_file_two =$the_file_3='';
									$image_line = strip_tags($row_two_in['news_id']);
									$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
									$dir = new DirectoryIterator($iteratepoint);
									
									foreach ($dir as $fileinfo) 
									{
										$date500_two = new DateTime($row_two_in['news_date']);
										//$J = date_format($date500_two,'l');
										$date_two = date_format($date500_two,'d F, Y  h:i:s A');
										$date_two = '<p style="color:red;">'.$date_two.'</p>';
										//$date_two = $J.', '.$Q;
										if($row_two_in['category'] =="Articles"){
											$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['author'].'</p>';
										}
										if (!$fileinfo->isDot()) 
										{
											$picky = $fileinfo->getFilename();
											if(substr_count($picky,"news_file") > 0){
												$date500_two = new DateTime($row_two_in['news_date']);
												$J = date_format($date500_two,'l');
												$Q = date_format($date500_two,'d F, Y  h:i:s A');
												$date_two = $J.', '.$Q;
												$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
												$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
												if($row_two_in['category'] =="Articles"){
													$date_two = $date_two.'<p style="color:black;"> By : '.$row_two_in['credited'].'</p>';
												}else{
													$date_two = $date_two. '<p style="color:black;"> Edited By : '.$row_two_in['author'].'</p>';
												}
												$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
												$the_file_3 ='<a style="color:red;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom:5px;margin-top:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																	<h5 style="text-align:right">Next Post >></h5>
																	<hr/>
																	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" >
																		<img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																	</div>
																	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" >'
																		.$date_two.
																	'</div>
																</div>
															</a>';
											}
										}
									}
									echo $the_file_3;
								}
							?>
							</div>
						</div><!--Previous and next ends here-->
			</div><!-- box 8 ends here -->
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="background-color:white;padding-top:10px"><!-- box 4 begins here -->
			<!--div class="row" -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>RELATED NEWS !!!<strong></h5>
						<hr />
						<?php
								//you may also wish to read
							$my_file_two="";
							$cars=str_split($title_here,5);
							$arrlength=count($cars);
							$already = array("ggg");
							for($x=0;$x<$arrlength;$x++)
							{
								$title_here_two = $cars[$x];

								$stmt = $conn->prepare("SELECT * FROM news where news_head like ? ORDER BY id DESC Limit 2");
								$stmt->execute(array("%$title_here_two%"));
								$affected_rows = $stmt->rowCount();
								if($affected_rows >= 1) 
								{	
									
									while($row_two = $stmt->fetch(PDO::FETCH_ASSOC))
									{
										
										
										if($row_two['news_head'] != $title_here)
										{
											
											if (!in_array($row_two['id'], $already))
											{
												array_push($already,$row_two['id']);
												$date500_two = new DateTime($row_two['news_date']);
												$J = date_format($date500_two,'l');
												$Q = date_format($date500_two,'d F, Y  h:i:s A');
												$date_two = $J.', '.$Q;
												$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two['news_head'].'</strong></h5>';
												$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
												if($row_two['category'] =="Articles"){
													$date_two = $date_two.'<p style="color:black;"> By : '.$row_two['credited'].'</p>';
												}else{
													$date_two = $date_two. '<p style="color:black;"> Edited By : '.$row_two['author'].'</p>';
												}
												$path_two="read_information_details.php?news_id=".$row_two['news_id'];
												$my_file_two ='<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">'
												.$date_two.
												'<hr/>
												</a>';
												echo $my_file_two;
											}
										}
									}
								}
							}
				
							
						?>			
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>LATEST NEWS !!!<strong></h5>
					<hr />
					<?php 
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC Limit 20");
						$stmt->execute();
						$affected_rows = $stmt->rowCount();
						if($affected_rows >= 1) 
						{	
							
							while($row_two = $stmt->fetch(PDO::FETCH_ASSOC))
							{
										$date500_two = new DateTime($row_two['news_date']);
										$J = date_format($date500_two,'l');
										$Q = date_format($date500_two,'d F, Y  h:i:s A');
										$date_two = $J.', '.$Q;
										$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two['news_head'].'</strong></h5>';
										$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
										if($row_two['category'] =="Articles"){
											$date_two = $date_two.'<p style="color:black;"> By : '.$row_two['credited'].'</p>';
										}else{
											$date_two = $date_two. '<p style="color:black;"> Edited By : '.$row_two['author'].'</p>';
										}
										$path_two="read_information_details.php?news_id=".$row_two['news_id'];
										$my_file_two ='<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">'
										.$date_two.
										'<hr/>
										</a>';
										echo $my_file_two;
							}
						}
						
					?>
					<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=latest" class="btn btn-primary"> View All Latest News &raquo; </a></p>
					
				</div>
			</div><!-- box 4 row here -->
		</div><!-- box 4 ends here -->	
			
		</div><!--close host news -->
	</div><!-- end row news -->
	<!-- c CLOSE -->
	<?php require_once 'settings/footer_file.php';?>
<!-- Container Ends -->
</div>
</body>