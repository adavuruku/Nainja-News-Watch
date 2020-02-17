<?php 
session_start(); 
require_once 'settings/connection.php';
//require_once 'settings/filter.php';

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Home | Nainja News Watch  </title>
<link rel="shortcut icon" href="settings/images/nainja.jpg">

<link rel="stylesheet" type="text/css" href="settings/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap-theme.css" >
<script type="text/javascript" src="settings/js/bootstrap.js"></script>
<script type="text/javascript" src="settings/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="settings/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="settings/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#EEEEEE;">
	<div class="container-fluid">
	<?php require_once 'settings/header_file.php';?>
		<!-- c -->
		<div class="row" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;">
				<h5 style="border-bottom-right-radius:2em;border-top-right-radius:2em;background:#dddddd;padding: 10px 0px 10px 10px;color:blue;"><b>Home >> Top Stories >> <strong style="color:red;"><?php
					$date500_two = new DateTime();
					$J = date_format($date500_two,"l");
					$Q = date_format($date500_two,"d F, Y");
					 $date_two = $J.", ".$Q;
					echo strtoupper($date_two);
				
				?></strong> </b></h5>
				<hr/>
			</div>
			<!-- cont before news -->
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="background-color:#eeeeee;">
				<div class="hidden-xs col-sm-12 col-md-12 col-lg-12" style="background-color:white;margin-bottom:10px;margin-top:10px;padding:5px 5px 5px 5px">
					<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3000" data-ride="carousel" style="background-color:white;padding:5px 0px 5px 0px;text-align:justify">
						<!-- Carousel indicators -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
							<li data-target="#myCarousel" data-slide-to="3"></li>
							<li data-target="#myCarousel" data-slide-to="4"></li>
						</ol>   
						<!-- Carousel items -->
						<div class="carousel-inner" style="background-color:white;">
							
							<?php
									$stmt_in = $conn->prepare("SELECT * FROM news where category!=? ORDER BY id DESC Limit 5");
									$stmt_in->execute(array("Videos"));
									$affected_rows_in = $stmt_in->rowCount();
									if($affected_rows_in >= 1) 
									{	
										$J = 0;
										$my_file_two ='';
										$image_file ='';
										while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
										{
											$J = $J +1;
											$class = "item";
											if($J==1){
												$class = "item active";
											}
												$image_line = strip_tags($row_two_in['news_id']);
												$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
												$dir = new DirectoryIterator($iteratepoint);
												$q = 0;
												
												foreach ($dir as $fileinfo) 
												{
														if (!$fileinfo->isDot()) 
														{
															$picky = $fileinfo->getFilename();
															if(substr_count($picky,"news_file") > 0){
																$image_file ='<img  style="height:200px" class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />';
															}
														}
																
												}
											$date500_two = new DateTime($row_two_in['news_date']);
											//$J = date_format($date500_two,'l');
											$date_two = date_format($date500_two,'d F, Y  h:i:s A');
											$date_two = '<p style="color:red;">'.$date_two.'</p>';
											if($row_two_in['category'] =="Articles"){
												$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
											}else{
												$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
											}
											/**$subj_two='';
											$subj_two = substr($row_two_in['news_info'],0,500);
											$body_two = htmlspecialchars_decode($subj_two)."...";
											$body_two= str_ireplace('<p>','',$body_two);
											$body_two= strip_tags($body_two);**/
											
											$subj_two='';
											$subj_two = $row_two_in['news_info'];
											$body_two = htmlspecialchars_decode($subj_two);
											$body_two= str_ireplace('<p>','',$body_two);
											$body_two= strip_tags($body_two);
											$body_two = substr($body_two,0,350)."...";
											
											$date_two = $date_two. '<p style="color:black;">'.$body_two.'</p>';
											$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
											$my_file_two =$my_file_two.'
													<div class="'.$class.'">
														<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:5px;padding-bottom:5px">
																<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" >'
																	.$image_file.'
																</div>
																<div class="col-xs-7 col-sm-7 col-md-7 col-lg-7" >
																	<h5><strong> '.$row_two_in['news_head'].'</strong></h5>
																	'.$date_two.'
																</div>
															</div>
														</a>
													</div>';
										}
										echo $my_file_two;
									}
							?>
													
						</div>
						<!-- Carousel nav -->
						<a class="carousel-control left" href="#myCarousel" data-slide="prev" >
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="carousel-control right" href="#myCarousel" data-slide="next" >
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div>
</div>
														
					
	
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<!-- work here  -->
					<?php
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT  distinct category,priority FROM news where category !=? ORDER BY priority ASC");
						$stmt->execute(array("Videos"));
						$affected_rows = $stmt->rowCount();
						if($affected_rows >= 1) 
						{	
							$r = 0;
							$r2=0;
							while($row_two = $stmt->fetch(PDO::FETCH_ASSOC))
							{
										//SEARCH FOR
									$r2 =$r2+1;	
										//start
										$stmt_in = $conn->prepare("SELECT * FROM news where category =? ORDER BY id DESC Limit 5");
										$stmt_in->execute(array($row_two['category']));
										$affected_rows_in = $stmt_in->rowCount();
										if($affected_rows_in >= 1) 
										{	
											$J = 0;
											$the_file_3 ='';
											while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
											{
												$J = $J +1;
												if($J==1){
													$image_line = strip_tags($row_two_in['news_id']);
																
																	$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
																	$dir = new DirectoryIterator($iteratepoint);
																	foreach ($dir as $fileinfo) 
																	{
																		if (!$fileinfo->isDot()) 
																		{
																			$picky = $fileinfo->getFilename();
																			if(substr_count($picky,"news_file") > 0){
																				$date500_two = new DateTime($row_two_in['news_date']);
																				//$J = date_format($date500_two,'l');
																				$date_two = date_format($date500_two,'d F, Y  h:i:s A');
																				$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
																				$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
																				//$date_two = $J.', '.$Q;
																				if($row_two_in['category'] =="Articles"){
																					$date_two = $date_two. '<p style="color:black;"> By : '.$row_two_in['credited'].'</p>';
																				}else{
																					$date_two = $date_two. '<p style="color:black;"> Edited By : '.$row_two_in['author'].'</p>';
																				}
																				$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
																				$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:5px;margin-top:5px;border-bottom-width:1px;border-bottom-style:dashed;">'
																													.$date_two.'<hr/>
																													<img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																													<hr/>
																												</div>
																										</a>';
																			}
																		}
																	}
												}else{	
														$image_line = strip_tags($row_two_in['news_id']);
																$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
																	$dir = new DirectoryIterator($iteratepoint);
																	foreach ($dir as $fileinfo) 
																	{
																		$date500_two = new DateTime($row_two_in['news_date']);
																		//$J = date_format($date500_two,'l');
																		$date_two = date_format($date500_two,'d F, Y  h:i:s A');
																		$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
																		$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
																		//$date_two = $J.', '.$Q;
																		if($row_two_in['category'] =="Articles"){
																			$date_two = $date_two. '<p style="color:black;"> By : '.$row_two_in['credited'].'</p>';
																		}else{
																			$date_two = $date_two. '<p style="color:black;"> Edited By : '.$row_two_in['author'].'</p>';
																		}
																		if (!$fileinfo->isDot()) 
																		{
																			$picky = $fileinfo->getFilename();
																			if(substr_count($picky,"news_file") > 0){
																				$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
																				$my_file_two =
																				$the_file_3 =$the_file_3.
																					'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:5px;border-bottom-width:1px;border-bottom-style:dashed;padding-bottom:5px">
																							<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5" >
																								<img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																							</div>
																							<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7" >'.
																								$date_two.
																							'</div>
																						</div>
																					</a>';
																			}
																		}
																	}
																
												}
									
										//end
										
									}
									$r = $r + 1;
									$path_more="view_more_news.php?news_c=".$row_two['category'];
										if($r == 2){
											echo '
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
												<p style="color:red;font-weight:bold;background-color:white;padding:15px 0px 15px 10px"><strong>'.strtoupper($row_two['category']).' NEWS. <strong></p>
										'.$the_file_3.'
												<p style="text-align:right;margin-top:10px;padding-bottom:10px;padding-right:10px;background-color:white;"><a href="'.$path_more.'" class="btn btn-primary pull right"> View More &raquo; </a></p>
												</div>
										</div>';
										$r=0;
											//$the_file_3="";
											}else{
											
												if($affected_rows ==$r2){
													echo '<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
															<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
															<p style="color:red;font-weight:bold;background-color:white;padding:15px 0px 15px 10px"><strong>'.strtoupper($row_two['category']).' NEWS.<strong></p>
													'.$the_file_3.'
														<p style="text-align:right;margin-top:10px;padding-bottom:10px;padding-right:10px;background-color:white;"><a href="'.$path_more.'" class="btn btn-primary pull right"> View More &raquo; </a></p></div></div>';
													}else{
														echo '<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
												<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
												<p style="color:red;font-weight:bold;background-color:white;padding:15px 0px 15px 10px"><strong>'.strtoupper($row_two['category']).' NEWS.<strong></p>
										'.$the_file_3.'
											<p style="text-align:right;margin-top:10px;padding-bottom:10px;padding-right:10px;background-color:white;"><a href="'.$path_more.'" class="btn btn-primary pull right"> View More &raquo; </a></p></div>';
																	}
												
											}
							}
						}
						}
					
					?>
					<!-- End here  -->
				</div>
			</div>
			<!-- end cont before news -->
			<!-- Latest News -->
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="background-color:white;border:2px;">
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
										if($row_two['category'] == "Videos"){
											$date_two_1 = '<h5 style="color:black;"><strong><span style="color:red;">[Watch Video]</span>  '.$row_two['news_head'].'</strong></h5>';
										}else{
											$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two['news_head'].'</strong></h5>';
										}
										
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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px">
					<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>OPINIONS / ARTICLES !!!<strong></h5>
					<hr />
					<?php 
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT * FROM news where news_type=? ORDER BY id DESC Limit 7");
						$stmt->execute(array("Articles"));
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
										if($row_two_in['category'] =="Articles"){
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
					<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Articles" class="btn btn-primary"> View All Opinions / Articles &raquo; </a></p>
					
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px">
					<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>SPORT NEWS !!!<strong></h5>
					<hr>
					<?php 
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT * FROM news where news_type=? ORDER BY id DESC Limit 7");
						$stmt->execute(array("Sports"));
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
										if($row_two_in['category'] =="Articles"){
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
					<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Sports" class="btn btn-primary"> View All Sport News &raquo; </a></p>
				</div>
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px">
					
					<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>ENTERTAINMENT NEWS !!!<strong></h5>
					<hr />
					<?php 
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT * FROM news where news_type=? ORDER BY id DESC Limit 7");
						$stmt->execute(array("Entertainment"));
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
										if($row_two_in['category'] =="Articles"){
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
					<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Entertainment" class="btn btn-primary"> View All Entertainment News &raquo; </a></p>
					
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px">
					
					<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>RELATIONSHIP NEWS !!!<strong></h5>
					<hr />
					<?php 
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT * FROM news where news_type=? ORDER BY id DESC Limit 7");
						$stmt->execute(array("Relationship"));
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
										if($row_two_in['category'] =="Articles"){
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
					<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Relationship" class="btn btn-primary"> View All Entertainment News &raquo; </a></p>
					
				</div>
			</div>
			<!-- Latest News Ends Container-->
		</div>
		<!-- c CLOSE -->
		<?php require_once 'settings/footer_index_file.php';?>
	<!-- Container Ends -->
	</div>
</body>