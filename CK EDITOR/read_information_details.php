<?php 
session_start(); 
require_once 'settings/connection.php';
require_once 'settings/filter.php';
//retrieve the news details


	$title_here=$body_here=$date_here=$category=$by=$credited=$id_news="";
	$search = strip_tags($_GET['news_id']);
	
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
			
			$date_here = $dateprint;
			$body_here =htmlspecialchars_decode($row['news_info']);
			$category=$row['category'];
			$by =$row['author'];
			$credited = $row['credited'];
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
				
				$date_here = $dateprint;
				$body_here =htmlspecialchars_decode(strip_tags($row['news_info']));
				$category=$row['category'];
				$by =$row['author'];
				$credited = $row['credited'];
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
<title>Ninja News Watch </title>
<link rel="shortcut icon" href="settings/images/title.jpg">

<meta property="og:locale" content="en_GB"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="How to Auto Post on Facebook with PHP"/>
<meta property="og:description" content="The lawyer wants the court to unfreeze his account."/>
<meta property="og:url" content="http://localhost/NinjaNewsWatch/read_information_details.php?news_id=27242360597947"/>
<meta property="og:site_name" content="Ninja News Watch"/>
<meta property="article:author" content="www.facebook.com/premiumtimes"/>
<meta property="og:image" content="http://localhost/NinjaNewsWatch/resourcefile/News_Files/27242360597947/news_file.jpg"/>
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

<style>

</style>
<?php //require_once 'settings/my_news_form.php';?>
</head>
<body style="background-color:#EEEEEE;">
<div class="container-fluid">
<?php require_once 'settings/header_file.php';?>
	<!-- c -->
	<div class="row" style="background-color:white;">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;">
			<h5 style="border-bottom-right-radius:2em;border-top-right-radius:2em;background:#dddddd;padding: 10px 0px 10px 10px;color:red;"><b>Home &raquo; <?php echo $category;?> &raquo; <span style="color:blue;"><?php echo $title_here;?></span></b></h5>
			<hr/>
		</div>
	</div><!-- ends row title -->
		
	<div  class="row" ><!-- cont row news -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;">
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="background-color:white;><!-- box 8 begin here -->
			<div  class="row" ><!-- 8 row news -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;"><!-- news detail heading  -->
					<h4 style="color:blue;font-weight:bold;font-name:tahoma;"><span style="color:red;"><?php echo $category;?> News : </span><?php echo $title_here;?></h4>
					<?php
						if($by !=""){
							echo '<p style="color:black;font-weight:bold;font-name:tahoma;">Edited By : '.$by.'</p>';
							$path_two="view_more_author_post.php?news_c=".$by;
							echo "<p ><a style='color:blue;font-weight:bold;font-name:tahoma;' href='".$path_two."'>View More Post From ".$by."</a></p>";
						}
						if($credited !=""){
							echo '<p style="color:black;font-weight:bold;font-name:tahoma;">Credited To : '.$credited.'</p>';
						}
					?>
					<p style="color:red;font-weight:bold;font-name:tahoma;"><?php echo $date_here;?></p>
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
											$my_2 = '<img  style="margin:15px 15px 15px 0px ;" class="img-responsive img-thumbnail pull-left" src="resourcefile/News_Files/'.$search.'/'.$picky.'" />';
										}
										if($number==3){
											$my_3 = '<img  style="margin:15px 15px 15px 0px;" class="img-responsive img-thumbnail pull-left" src="resourcefile/News_Files/'.$search.'/'.$picky.'" />';
										}
									}
									
								}
							}
						
					?>
				</div><!-- info pics -->
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom:35px;background-color:white;text-align:justify;font-style:Tahoma"><!-- info datas -->			
					<?php 
						//echo $body_here.$number;
						$len_T = strlen($body_here);
						$last_L = ($len_T/($number+1));
						if($number==1){
							echo substr($body_here,0,$last_L).$my_1.substr($body_here,($last_L),$last_L);
						}
						else if($number==2){
							echo substr($body_here,0,$last_L).$my_1.substr($body_here,($last_L),$last_L)
							.$my_2.substr($body_here,($last_L*2),$last_L);
						}else if($number==3){
							echo substr($body_here,0,$last_L).$my_1.substr($body_here,($last_L),$last_L)
							.$my_2.substr($body_here,($last_L*2),$last_L);
						}else{
							echo $body_here;
						}
						
					?>
				</div><!-- info datas ends -->
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom:10px;margin-bottom:15px;background-color:white;text-align:justify;font-style:Tahoma">
					<hr/>
					<div  class="row"><!-- next previous row begin -->
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
											$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
											$previous ='<h4 style="color:red" > <a style="color:red;text-decoration:none;font-weight:bold;" href="'.$path_two.'"><< Previous Post </a></h4>';
											$my_file_two ='<h5><a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">'.$row_two_in['news_head'].'</a></h5>'.$date_two;
											$the_file_3 =$the_file_3 .'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom:5px;margin-top:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
											'.$previous.'
												<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" ><img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" /></div>';
											$the_file_3 =$the_file_3.'<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >'.$my_file_two.'</div></div>';								
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
											$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
											$previous ='<h4 style="color:red" > <a style="color:red;text-decoration:none;font-weight:bold;" href="'.$path_two.'">Next Post >> </a></h4>';
											$my_file_two ='<h5><a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">'.$row_two_in['news_head'].'</a></h5>'.$date_two;
											$the_file_3 =$the_file_3 .'<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom:5px;margin-top:5px;padding-bottom:5px">
											'.$previous.'
												<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" ><img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" /></div>';
											$the_file_3 =$the_file_3.'<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >'.$my_file_two.'</div></div>';
										}
									}
								}
								echo $the_file_3;
							}
						?>
					</div><!-- next previous row ends -->
				</div><!-- next previous -->
			</div><!-- box 8 row ends -->
		</div><!-- box 8 ends here -->
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="background-color:white;padding-top:10px"><!-- box 4 begins here -->
			<!--div class="row" -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<p style="color:red;font-weight:bold;background-color:#eeeeee;padding:15px 0px 15px 10px"><strong>RELATED NEWS....</strong></p>
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
												$J = date_format($date500_two,"l");
												$Q = date_format($date500_two,"d F, Y  h:i:s A");
												$date_two = $J.", ".$Q;
												$subj_two="";
												$subj_two = substr($row_two['news_info'],0,100);
												$body_two = htmlspecialchars_decode($subj_two)."...";
												$path_two="read_information_details.php?news_id=".$row_two['news_id'];
												
												//$title ="<p >".$row_two['news_head']."</p>";
												$my_file_two =$my_file_two."<h5><a style='color:blue;text-decoration:none;font-weight:bold;' href='".$path_two."'>".$row_two['news_head']."</a></h5>
												<p style='color:red;'>".$date_two."</p><hr/>";
												echo $my_file_two;
											}
										}
									}
								}
							}
				
							
						?>			
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<p style="color:red;font-weight:bold;background-color:#eeeeee;padding:15px 0px 15px 10px"><strong>LATEST NEWS....</strong></p>
					<hr />
					<?php 
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC Limit 10");
						$stmt->execute();
						$affected_rows = $stmt->rowCount();
						if($affected_rows >= 1) 
						{	
							
							while($row_two = $stmt->fetch(PDO::FETCH_ASSOC))
							{
										$date500_two = new DateTime($row_two['news_date']);
										$J = date_format($date500_two,"l");
										$Q = date_format($date500_two,"d F, Y  h:i:s A");
										$date_two = $J.", ".$Q;
										$path_two="read_information_details.php?news_id=".$row_two['news_id'];
										//$title ="<p >".$row_two['news_head']."</p>";
										$my_file_two ="<h5><a style='color:black;text-decoration:none;font-weight:bold;' href='".$path_two."'>".$row_two['news_head']."</a></h5>
										<p style='color:red;'>".$date_two."</p><hr/>";
										echo $my_file_two;
							}
						}
						
					?>
					<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=latest" class="btn btn-primary"> View All Latest News &raquo; </a></p>
					
				</div>
			</div><!-- box 4 row here -->
		</div><!-- box 4 ends here -->	
	</div><!-- end row news -->
	<!-- c CLOSE -->
	<?php require_once 'settings/footer_file.php';?>
<!-- Container Ends -->
</div>
</body>