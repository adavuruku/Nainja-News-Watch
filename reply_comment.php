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
			$sth = $conn->prepare ("INSERT INTO news_reply (email,post_name,comment_id,comment,reply_id,like_reply,date_post)
														VALUES (?,?,?,?,?,?,now())");																
					$sth->bindValue (1, $txtEmail);
					$sth->bindValue (2, $txtName);
					$sth->bindValue (3, $search);
					$sth->bindValue (4, $a_description);
					$sth->bindValue (5, $folder_name);
					$sth->bindValue (6, $status);
					$sth->bindValue (7, $status);
					if($sth->execute()){
						$stmt = $conn->prepare("UPDATE news_comment SET reply = reply + 1 WHERE comment_id=? Limit 1");
						$stmt->execute(array($search));
					}

		}else{
			$err = '<p style="color:red">Fail to Post Comment Invalid Information Provided </p>';
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
			<h5 style="border-bottom-right-radius:2em;border-top-right-radius:2em;background:#dddddd;padding: 10px 0px 10px 10px;color:red;"><b>Home &raquo; Reply Comment &raquo; <span style="color:blue;"><?php echo $title_here;?></span></b></h5>
			<hr/>
		</div>
	</div><!-- ends row title -->
		
	<div  class="row"><!-- cont row news -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;"><!-- host news -->
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="background-color:white;"><!-- box 8 begin here -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;"><!-- news detail heading  -->
				<?php
					$my_file_two=null;
					$stmt_in = $conn->prepare("SELECT * FROM news_comment where comment_id =? limit 1");
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

									$likes = '<h3 style="color:white;"><span style="cursor:pointer;" '.$id_link.' onclick="like_news_comment(\''.$row_two['comment_id'].'\')" class="label label-primary likeme">'.$likes.'</span>  | 
													
													<span class="label label-primary">'.$reply.' </span></h3>';
									
									$my_file_two = $my_file_two.'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:white;color:black;margin-bottom:15px">
																'.$date_two.$likes.'
															</div>';
						}
						echo $my_file_two;
					}
				?>
				</div><!-- info datas ends -->
				
				<!--Previous and next begin here-->
				
			<div class="row"><!--Comments begins-->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#eeeeee;" >
					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#eeeeee;color:white;margin-bottom:0px;margin-top:15px" >
								<hr />
									<?php 
										$my_file_two ="";
										$stmt_ina = $conn->prepare("SELECT * FROM news_reply where comment_id =?");
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

										$stmt_in = $conn->prepare("SELECT * FROM news_reply where comment_id=? ORDER BY id DESC Limit {$per_page} OFFSET {$offset} ");
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
														$path_two="reply_comment.php?news_id=".$row_two['reply_id'];
														$id_link =" id=".'"'.$row_two['reply_id'].'"';
														$likes= $row_two['like_reply'];
														$likes_js= $row_two['like_reply'];
														if($likes>0){
															$likes = $likes." Likes";
														}else{
															$likes = "Like";
														}



														$likes = '<h4 style="color:white;"><span style="cursor:pointer;" '.$id_link.' onclick="like_news_reply(\''.$row_two['reply_id'].'\')" 
														class="label label-primary likeme">'.$likes.' </span> </h4>';
														
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
															echo '<li><a style="background-color:grey;color:white" href=reply_comment.php?page='.$previous_page.'&news_id='.$search.'>&laquo; View Previous Comments</a> </li>';
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
														echo '<li><a style="background-color:grey;color:white" href=reply_comment.php?page='.$next_page.'&news_id='.$search.'>View More Comments &raquo;</a></li> ';
													}
											echo '</ul></div>';
										}
									?>
							</div>	
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#eeeeee;">
						<hr />

						<h5>Post Your Reply</h5>
						<?php echo $err;?>
						<form role="form" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
						
							<input type="hidden" value="<?php echo $search; ?>" id="news_id" name="news_id"/>
						    <div class="form-group">
						        <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $txtEmail; ?>" placeholder="Enter Email">
						    </div>
						    <div class="form-group">
						        <input type="text" class="form-control" id="txtName" name="txtName" value="<?php echo $txtName; ?>" placeholder="Enter Name">
						    </div>
						    <div class="form-group">
						        <textarea  rows="3" class="form-control"  id="a_description" name="a_description" value="">
														
										<?php //echo $a_description;?>
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
			
			</div><!-- box 8 ends here -->
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="background-color:white;padding-top:10px"><!-- box 4 begins here -->
			<!--div class="row" -->
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