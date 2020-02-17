<?php 
session_start(); 
require_once 'settings/connection.php';
require_once 'settings/filter.php';
if(isset($_GET['news_c'])){
	$news_c=strip_tags($_GET['news_c']);
	$news_c=htmlspecialchars_decode($news_c);
	$news_c = str_replace("_"," ",$news_c);
}else{
	header("location: index.php");
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Nainja News Watch  </title>
<link rel="shortcut icon" href="settings/images/nainja.jpg">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="settings/css/bootstrap-theme.css" >
<script type="text/javascript" src="settings/js/bootstrap.js"></script>
<script type="text/javascript" src="settings/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="settings/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="settings/js/bootstrap.min.js"></script>

<?php //require_once 'settings/my_news_form.php';?>
</head>
<body style="background-color:#EEEEEE;">
	<div class="container-fluid">
	<?php require_once 'settings/header_file.php';?>
		<!-- c -->
		<div class="row" >
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;">
				<h5 style="border-bottom-right-radius:2em;border-top-right-radius:2em;background:#dddddd;padding: 10px 0px 10px 10px;color:red;"><b>Home &raquo; VIEW MORE NEWS FROM <span style="color:blue;font-family:Due;"><?php echo strtoupper($news_c);?> </span></b></h5>
				<hr/>
			</div>
			<!-- cont before news -->
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="background-color:#eeeeee;">
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<!-- work here  -->
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px;background-color:white;">
						<p style="color:red;font-weight:bold;background-color:white;padding:15px 0px 0px 10px;"><strong>NEWS EDITED BY <span style="color:blue;font-family:Due;"><?php echo strtoupper($news_c);?></span>  !! &raquo;<strong></p>
						<hr/>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
					<?php
						
							$stmt_ina = $conn->prepare("SELECT * FROM news where author=?");
							$stmt_ina->execute(array($news_c));
						$affected_rows_ina = $stmt_ina->rowCount();
						$current_page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
						$total_count = $affected_rows_ina;
						//record per Page($per_page)	
						$per_page = 32;//26
						$total_pages = ceil($total_count/$per_page);
						//get the offset current page minus 1 multiply by record per page
						//offset is where the record counting should start and where it should end
						//is always calculate as the number u click on minus one times the number of page that
						//shoul be dispaly in each page i.e (2-1)*10 = 1*10 = 10
						//(3-1)*10 = 20
						//4=30 5=40 e.t.c
						$offset = ($current_page - 1) * $per_page;
						//in every click set the previous pages and next page clicking down in case any body click on it
						//move to previous record by subtracting one into the current record
						$previous_page = $current_page - 1;
						//mvove to next record by incrementing the current page by one		
						$next_page = $current_page + 1;
						//check if previous record is still greater than one then it returns to true
						$has_previous_page =  $previous_page >= 1 ? true : false;
						//check if Next record is still lesser than one total pages then it returns to true
						$has_next_page = $next_page <= $total_pages ? true : false;
						
						
						
										//SEARCH FOR
										
										//start
										
											$stmt_in = $conn->prepare("SELECT * FROM news where author=? ORDER BY id DESC Limit {$per_page} OFFSET {$offset} ");
											$stmt_in->execute(array($news_c));
										$affected_rows_in = $stmt_in->rowCount();
										if($affected_rows_in >= 1) 
										{	
											$J = 0;
											
											$r=0;
											while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
											{
												$my_file_two =$the_file_3='';
												$J=$J+1;
														$image_line = strip_tags($row_two_in['news_id']);
																$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
																	$dir = new DirectoryIterator($iteratepoint);
																	foreach ($dir as $fileinfo) 
																	{
																		$date500_two = new DateTime($row_two_in['news_date']);
																		//$J = date_format($date500_two,'l');
																		$date_two = date_format($date500_two,'d F, Y  h:i:s A');
																		$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
																		$date_two = $date_two_1.'<p style="color:red;">'.$date_two.'</p>';
																		//$date_two = $J.', '.$Q;
																		$date_two = $date_two. '<p style="color:black;"> Posted By : '.$row_two_in['author'].'</p>';
																		if($row_two_in['credited'] !=""){
																			$date_two = $date_two. '<p style="color:red;"> Author : '.$row_two_in['credited'].'</p>';
																		}

																		if (!$fileinfo->isDot()) 
																		{
																			$picky = $fileinfo->getFilename();
																			 if(substr_count($picky,"news_file") > 0){
																				$the_file = $picky;
																			}
																		}
																	}
														$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
														//if()
														$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:5px;margin-top:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
																					<img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$the_file.'" />
																				</div>
																				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >'
																				.$date_two.'</div>
																			</div>
																		</a>';
														$r = $r + 1;
														//$path_more="view_more_news.php?news_c=".$row_two['category'];
														//$path_more="view_more_news.php?news_c=Politics";
															if($r == 2){
																echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
															'.$the_file_3.'</div>
															</div>';
															
															$r=0;
																//$the_file_3="";
																}else{
																	if($affected_rows_in ==$J){
																		echo '<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;background-color:white;">
																		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">'.$the_file_3.'</div></div>';
																	}else{
																		echo '<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;background-color:white;">
																		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">'.$the_file_3.'</div>';
																	
																	}
																}
																
											}
									
										//end
										
									}
									echo '<div class="row" style="margin-bottom:5px;margin-top:5px;border-width:2px solid;background-color:white;">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">	
												<ul class="pagination" align="center">';
												$news_c = str_replace(" ","_",$news_c);									
													if ($total_pages > 1)
													{
														//this is for previous record
														if ($has_previous_page)
														{
															echo ' <li><a href=view_more_author_post.php?page='.$previous_page.'&news_c='.$news_c.'>&laquo; </a> </li>';
														}
														 //it loops to all pages
														 for($i = 1; $i <= $total_pages; $i++)
														 {
															//check if the value of i is set to current page	
															if ($i == $current_page)
															{
															//then it sset the i to be active or focused
																echo '<li class="active"><span>'. $i.' <span class="sr-only">(current)</span></span></li>';
															 }
															 else
															 {
															 //display the page number
																echo ' <li><a href=view_more_author_post.php?page='.$i.'&news_c='.$news_c.'> '. $i .' </a></li>';
															 }
														 }
														//this is for next record		
														if ($has_next_page)
														{
														echo ' <li><a href=view_more_author_post.php?page='.$next_page.'&news_c='.$news_c.'>&raquo;</a></li> ';
														}
														
													}
									
									echo '</div></div></ul>';
									
					
					?>
					<!-- End here  -->
					</div>
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
						$stmt = $conn->prepare("SELECT * FROM news ORDER BY id DESC Limit 10");
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
					<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=latest" class="btn btn-primary"> View All Latest News &raquo; </a></p>
					
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:10px">
					<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>OPINIONS / ARTICLES !!!<strong></h5>
					<hr />
					<?php 
						$my_file_two ="";
						$stmt = $conn->prepare("SELECT * FROM news where news_type=? ORDER BY id DESC Limit 5");
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
						$stmt = $conn->prepare("SELECT * FROM news where news_type=? ORDER BY id DESC Limit 5");
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
						$stmt = $conn->prepare("SELECT * FROM news where news_type=? ORDER BY id DESC Limit 5");
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
			</div>
			<!-- Latest News Ends Container-->
		</div>
		<!-- c CLOSE -->
		<?php require_once 'settings/footer_file.php';?>
	<!-- Container Ends -->
	</div>
</body>