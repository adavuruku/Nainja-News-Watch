<?php

?>
<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
            <div class="col-xs-12" style="padding-bottom:10px;padding-top:10px;background-color:white;">
            	<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>POLITICAL NEWS ...<strong></h5>
					<hr />
                <!-- Sponsored News-->
				<?php
					$stmt_in = $conn->prepare("SELECT * FROM news where category =? order by id desc limit 4");
					$stmt_in->execute(array("Politics"));
					$affected_rows_in = $stmt_in->rowCount();
					if($affected_rows_in >= 1) 
					{	
						$J = 0;
						$the_file_3 ='';
						while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
						{
							//echo $row_two_in['read'];
							$image_line = strip_tags($row_two_in['news_id']);
							$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
							$dir = new DirectoryIterator($iteratepoint);
							foreach ($dir as $fileinfo) 
							{
								$date500_two = new DateTime($row_two_in['news_date']);
								//$J = date_format($date500_two,'l');
								$date_two = date_format($date500_two,'d F, Y  h:i:s A');
								$date_two = '<p style="color:red;">'.$date_two.'</p>';
								$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
								$body_here =substr($subj_two,0,300);
								$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
								$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
								if($row_two_in['category'] =="Articles"){
									$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
								}else{
									$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
								}
								$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
								if (!$fileinfo->isDot()) 
								{
									$picky = $fileinfo->getFilename();
									if(substr_count($picky,"news_file") > 0){
										$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
										$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
															<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																	<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																</div>
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																.$date_two.
																'</div>
															</div>
													</a>';
									}
								}
							}
											
						}
						echo $the_file_3;
	
					}
				?>
				<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Politics" class="btn btn-primary"> View More &raquo; </a></p>
				<!-- Sponsored News-->
            </div>
        </div>
		<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
            <div class="col-xs-12" style="padding-bottom:10px;padding-top:10px;background-color:white;">
            	<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>MOST READ NEWS ...<strong></h5>
					<hr />
                <!-- Sponsored News-->
				<?php
					$stmt_in = $conn->prepare("SELECT * FROM news order by no_read desc limit 4");
					$stmt_in->execute();
					$affected_rows_in = $stmt_in->rowCount();
					if($affected_rows_in >= 1) 
					{	
						$J = 0;
						$the_file_3 ='';
						while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
						{
							//echo $row_two_in['read'];
							$image_line = strip_tags($row_two_in['news_id']);
							$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
							$dir = new DirectoryIterator($iteratepoint);
							foreach ($dir as $fileinfo) 
							{
								$date500_two = new DateTime($row_two_in['news_date']);
								//$J = date_format($date500_two,'l');
								$date_two = date_format($date500_two,'d F, Y  h:i:s A');
								$date_two = '<p style="color:red;">'.$date_two.'</p>';
								$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
								$body_here =substr($subj_two,0,300);
								$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
								$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
								if($row_two_in['category'] =="Articles"){
									$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
								}else{
									$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
								}
								$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
								if (!$fileinfo->isDot()) 
								{
									$picky = $fileinfo->getFilename();
									if(substr_count($picky,"news_file") > 0){
										$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
										$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
															<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																	<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																</div>
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																.$date_two.
																'</div>
															</div>
													</a>';
									}
								}
							}
											
						}
						echo $the_file_3;
	
					}
				?>
				<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=trending" class="btn btn-primary"> View More &raquo; </a></p>
				<!-- Sponsored News-->
            </div>
        </div>
		<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
            <div class="col-xs-12" style="padding-bottom:10px;padding-top:10px;background-color:white;">
            	<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>SPORTS NEWS ...<strong></h5>
					<hr />
                <!-- Sponsored News-->
				<?php
					$stmt_in = $conn->prepare("SELECT * FROM news where category =? order by id desc limit 4");
					$stmt_in->execute(array("Sports"));
					$affected_rows_in = $stmt_in->rowCount();
					if($affected_rows_in >= 1) 
					{	
						$J = 0;
						$the_file_3 ='';
						while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
						{
							//echo $row_two_in['read'];
							$image_line = strip_tags($row_two_in['news_id']);
							$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
								$dir = new DirectoryIterator($iteratepoint);
								foreach ($dir as $fileinfo) 
								{
									$date500_two = new DateTime($row_two_in['news_date']);
									//$J = date_format($date500_two,'l');
									$date_two = date_format($date500_two,'d F, Y  h:i:s A');
									$date_two = '<p style="color:red;">'.$date_two.'</p>';
									$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
									$body_here =substr($subj_two,0,300);
									$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
									$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
									if($row_two_in['category'] =="Articles"){
										$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
									}else{
										$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
									}
									$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
									if (!$fileinfo->isDot()) 
									{
										$picky = $fileinfo->getFilename();
										if(substr_count($picky,"news_file") > 0){
											$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
											$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																		<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																	</div>
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																	.$date_two.
																	'</div>
																</div>
														</a>';
										}
									}
								}
											
						}
						echo $the_file_3;
	
					}
				?>
				<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Sports" class="btn btn-primary"> View More &raquo; </a></p>
				<!-- Sponsored News-->
            </div>
        </div>
		<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
            <div class="col-xs-12" style="padding-bottom:10px;padding-top:10px;background-color:white;">
            	<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>ARTICLES NEWS ...<strong></h5>
					<hr />
                <!-- Sponsored News-->
				<?php
					$stmt_in = $conn->prepare("SELECT * FROM news where category =? order by id desc limit 4");
					$stmt_in->execute(array("Articles"));
					$affected_rows_in = $stmt_in->rowCount();
					if($affected_rows_in >= 1) 
					{	
						$J = 0;
						$the_file_3 ='';
						while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
						{
							//echo $row_two_in['read'];
							$image_line = strip_tags($row_two_in['news_id']);
											$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
												$dir = new DirectoryIterator($iteratepoint);
												foreach ($dir as $fileinfo) 
												{
													$date500_two = new DateTime($row_two_in['news_date']);
													//$J = date_format($date500_two,'l');
													$date_two = date_format($date500_two,'d F, Y  h:i:s A');
													$date_two = '<p style="color:red;">'.$date_two.'</p>';
													$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
													$body_here =substr($subj_two,0,300);
													$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
													$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
													if($row_two_in['category'] =="Articles"){
														$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
													}else{
														$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
													}
													$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
													if (!$fileinfo->isDot()) 
													{
														$picky = $fileinfo->getFilename();
														if(substr_count($picky,"news_file") > 0){
															$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
															$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																						<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																					</div>
																					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																					.$date_two.
																					'</div>
																				</div>
																		</a>';
														}
													}
												}
											
						}
						echo $the_file_3;
	
					}
				?>
				<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Articles" class="btn btn-primary"> View More &raquo; </a></p>
				<!-- Sponsored News-->
            </div>
        </div>
		<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
            <div class="col-xs-12" style="padding-bottom:10px;padding-top:10px;background-color:white;">
            	<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>ENTERTAINMENT NEWS ...<strong></h5>
					<hr />
                <!-- Sponsored News-->
				<?php
					$stmt_in = $conn->prepare("SELECT * FROM news where category =? order by id desc limit 4");
					$stmt_in->execute(array("Entertainment"));
					$affected_rows_in = $stmt_in->rowCount();
					if($affected_rows_in >= 1) 
					{	
						$J = 0;
						$the_file_3 ='';
						while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
						{
							//echo $row_two_in['read'];
							$image_line = strip_tags($row_two_in['news_id']);
							$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
								$dir = new DirectoryIterator($iteratepoint);
								foreach ($dir as $fileinfo) 
								{
									$date500_two = new DateTime($row_two_in['news_date']);
									//$J = date_format($date500_two,'l');
									$date_two = date_format($date500_two,'d F, Y  h:i:s A');
									$date_two = '<p style="color:red;">'.$date_two.'</p>';
									$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
									$body_here =substr($subj_two,0,300);
									$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
									$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
									if($row_two_in['category'] =="Articles"){
										$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
									}else{
										$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
									}
									$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
									if (!$fileinfo->isDot()) 
									{
										$picky = $fileinfo->getFilename();
										if(substr_count($picky,"news_file") > 0){
											$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
											$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																		<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																	</div>
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																	.$date_two.
																	'</div>
																</div>
														</a>';
										}
									}
								}
											
						}
						echo $the_file_3;
	
					}
				?>
				<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=Entertainment" class="btn btn-primary"> View More &raquo; </a></p>
				<!-- Sponsored News-->
            </div>
        </div>
		<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
            <div class="col-xs-12" style="padding-bottom:10px;padding-top:10px;background-color:white;">
				<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>MOST COMMENTED NEWS ...<strong></h5>
					<hr />
                <!-- Sponsored News-->
				<?php
					$stmt_in = $conn->prepare("SELECT * FROM news where category =? order by no_comment desc limit 4");
					$stmt_in->execute(array("Politics"));
					$affected_rows_in = $stmt_in->rowCount();
					if($affected_rows_in >= 1) 
					{	
						$J = 0;
						$the_file_3 ='';
						while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
						{
							//echo $row_two_in['read'];
							$image_line = strip_tags($row_two_in['news_id']);
							$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
							$dir = new DirectoryIterator($iteratepoint);
							foreach ($dir as $fileinfo) 
							{
								$date500_two = new DateTime($row_two_in['news_date']);
								//$J = date_format($date500_two,'l');
								$date_two = date_format($date500_two,'d F, Y  h:i:s A');
								$date_two = '<p style="color:red;">'.$date_two.'</p>';
								$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
								$body_here =substr($subj_two,0,300);
								$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
								$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
								if($row_two_in['category'] =="Articles"){
									$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
								}else{
									$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
								}
								$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
								if (!$fileinfo->isDot()) 
								{
									$picky = $fileinfo->getFilename();
									if(substr_count($picky,"news_file") > 0){
										$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
										$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
															<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																	<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																</div>
																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																.$date_two.
																'</div>
															</div>
													</a>';
									}
								}
							}
											
						}
						echo $the_file_3;
	
					}
		

				?>
				<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=commented" class="btn btn-primary"> View More &raquo; </a></p>
				<!-- Sponsored News-->
            </div>
        </div>
		<div class="row" style="margin-bottom:10px;margin-top:10px;border-width:2px solid;">
            <div class="col-xs-12" style="padding-bottom:10px;padding-top:10px;background-color:white;">
            	<h5 style="color:white;font-weight:bold;background-color:grey;padding:15px 0px 15px 10px"><strong>NAINJA NEWS ARCHIVES NEWS ...<strong></h5>
				
					<hr />
                <!-- Sponsored News-->
				<?php
					//count no of records
					$stmt_int = $conn->prepare("SELECT * FROM news");
					$stmt_int->execute();
					$affected_rows_int= $stmt_int->rowCount();
					$the_file_3 ='';
					for($i=1;$i<=4;$i++)
					{
							$search_id = mt_rand(1,$affected_rows_int);
							
							$stmt_in = $conn->prepare("SELECT * FROM news where id =? limit 1");
							$stmt_in->execute(array($search_id));
							$affected_rows_in = $stmt_in->rowCount();
							if($affected_rows_in >= 1) 
							{
								$row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC);
								$image_line = strip_tags($row_two_in['news_id']);
								$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
								$dir = new DirectoryIterator($iteratepoint);
								foreach ($dir as $fileinfo) 
								{
									$date500_two = new DateTime($row_two_in['news_date']);
									//$J = date_format($date500_two,'l');
									$date_two = date_format($date500_two,'d F, Y  h:i:s A');
									$date_two = '<p style="color:red;">'.$date_two.'</p>';
									$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
									$body_here =substr($subj_two,0,300);
									$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
									$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
									if($row_two_in['category'] =="Articles"){
										$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
									}else{
										$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
									}
									$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
									if (!$fileinfo->isDot()) 
									{
										$picky = $fileinfo->getFilename();
										if(substr_count($picky,"news_file") > 0){
											$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
											$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																		<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																	</div>
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																	.$date_two.
																	'</div>
																</div>
														</a>';
										}
									}
								}
													
							}else{
							
							$search_id = mt_rand(1,$affected_rows_int);
							$stmt_in = $conn->prepare("SELECT * FROM news where id =? limit 1");
							$stmt_in->execute(array($search_id));
							$affected_rows_in = $stmt_in->rowCount();
							if($affected_rows_in >= 1) 
							{
								$row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC);
								$image_line = strip_tags($row_two_in['news_id']);
								$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
								$dir = new DirectoryIterator($iteratepoint);
								foreach ($dir as $fileinfo) 
								{
									$date500_two = new DateTime($row_two_in['news_date']);
									//$J = date_format($date500_two,'l');
									$date_two = date_format($date500_two,'d F, Y  h:i:s A');
									$date_two = '<p style="color:red;">'.$date_two.'</p>';
									$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
									$body_here =substr($subj_two,0,300);
									$date_two_1 = '<h5 style="color:black;"><strong>'.$row_two_in['news_head'].'</strong></h5>';
									$date_two = $date_two_1. '<p style="color:red;">'.$date_two.'</p>';
									if($row_two_in['category'] =="Articles"){
										$date_two = $date_two. '<p style="color:blue;"> By : '.$row_two_in['credited'].'</p>';
									}else{
										$date_two = $date_two. '<p style="color:blue;"> Edited By : '.$row_two_in['author'].'</p>';
									}
									$date_two = $date_two.'<p style="color:white;">'.trim($body_here).'... </p>';
									if (!$fileinfo->isDot()) 
									{
										$picky = $fileinfo->getFilename();
										if(substr_count($picky,"news_file") > 0){
											$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
											$the_file_3 =$the_file_3.'<a style="color:black;text-decoration:none;font-weight:bold;" href="'.$path_two.'">
																<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="padding-bottom:10px;padding-top:10px;margin-bottom:5px;border-right-width:1px;border-right-style:dashed;padding-bottom:5px">
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
																		<img class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" />
																	</div>
																	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'
																	.$date_two.
																	'</div>
																</div>
														</a>';
										}
									}
								}
							
							}
						}
					}
					echo $the_file_3;
				?>
				<p style="text-align:right;margin-top:10px"><a href="view_more_news.php?news_c=archives" class="btn btn-primary"> View More &raquo; </a></p>
				<!-- Sponsored News-->
            </div>
        </div>
<div class="row" style="margin-top:15px;text-align:justify;background-color:black;padding-top:15px;text-align:justify;color:white;">
				<footer>
				<div  class="col-sm-12 col-md-12 col-lg-12" >
					<div  class="col-sm-3 col-md-3 col-lg-3" style="border-right-width:2px;border-right-style:dashed;">
						<h5 style="color:red;"><u><i><b/>Address & Contact</i></u></h5>
						<p><i>D41 Inike Okene Kogi State <br/> Phone : 08164377187 - 07034761741 <br/> Email : aabdulraheemsherif@gmail.com <br/><br/></i></p>
						<h6 align="center">Follow Us :</h6> <p align="center">
							<a href="#" ><img style="height:50px" src="settings/images/facebook.png" id="social" /></a>
							<a href="#"><img style="height:50px" src="settings/images/twitter.png" id="social" /></a>
							<a href="#"><img style="height:50px" src="settings/images/linkedin.png" id="social"  /></a>
							<a href="#"><img style="height:50px" src="settings/images/youtube.png" id="social" /></a>
							<a href="#"><img style="height:50px" src="settings/images/gmail.png" id="social" /></a></p>
					</div>
					<div  class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-right-width:2px;border-right-style:dashed;">
						<p style="color:red;"><u><i><b/>More News Link &raquo;</i></u></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="index.php">News</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Sports">Sports</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Politics">Politics</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Business">Business</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Tech">Tech</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Entertainment">Entertainment</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Articles">Opinion / Articles</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Features / Interview">Features / Interviews</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Health">Health</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Relationship">Relationship</a></p>
							<p style="padding: 5px 5px 5px 5px;background-color:white"><a href="view_more_news.php?news_c=Metro">Metro</a></p>
						<!--	<embed src="settings/enterauthorizationcode.mp3" controller="true" autoplay="true" autostart="True" width="0" height="0" />-->
					</div>
					<div  class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-right-width:2px;border-right-style:dashed;">
						<h5 style="color:red;"><u><i><b/>About Us</i></u></h5>
						<p>NinjaNewsWatch.com is one of Nigeria's leading on-line destinations for the latest Nigerian trending news and updates, helpful articles
						and a community sharing the best, latest information on Nigeria and things that concern Nigerians .</p>
						<p>Some of the topics we cover include political news, metro, sports, tech, apinion / articles,features / interviews business and entertainment. In addition we provide articles on careers, health, technology, travel
						and money. These articles are designed to help Nigerians make informed decisions in their every day personal and professional lives</p>
					</div>
					<div  class="col-xs-12 col-sm-3 col-md-3 col-lg-3" style="border-right-width:2px;border-right-style:dashed;background-color:grey">
						<h5 style="color:red;"><u><i><b/>Just In </i></u></h5>
						<?php
							$stmt_in = $conn->prepare("SELECT * FROM news where category =? order by id desc limit 1");
												$stmt_in->execute(array("Politics"));
												$affected_rows_in = $stmt_in->rowCount();
												if($affected_rows_in >= 1) 
												{	
													$J = 0;
													$the_file_3 ='';
													while($row_two_in = $stmt_in->fetch(PDO::FETCH_ASSOC))
													{
														//echo $row_two_in['read'];
														$image_line = strip_tags($row_two_in['news_id']);
														$iteratepoint = 'resourcefile/News_Files/'.$image_line.'/';
														$dir = new DirectoryIterator($iteratepoint);
														foreach ($dir as $fileinfo) 
														{
															$date500_two = new DateTime($row_two_in['news_date']);
															$date_two = date_format($date500_two,'d F, Y  h:i:s A');
															$date_two = '<p style="color:yellow;margin-top:5px">'.$date_two.'</p>';
															$subj_two = htmlspecialchars_decode($row_two_in['news_info']);
															$body_here =substr($subj_two,0,600);
															$body_here = '<p style="color:white;">'.$body_here.'... </p>';
															if($row_two_in['category'] =="Articles"){
																$date_two = $date_two. '<p style="color:white;"> By : '.$row_two_in['author'].'</p>';
															}
															$date_two = $date_two.$body_here;
															if (!$fileinfo->isDot()) 
															{
																$picky = $fileinfo->getFilename();
																if(substr_count($picky,"news_file") > 0){
																	$path_two="read_information_details.php?news_id=".$row_two_in['news_id'];
																	$my_file_two ='<h5><a style="color:white;text-decoration:none;font-weight:bold;" href="'.$path_two.'">'.$row_two_in['news_head'].$date_two.'</a></h5>';
																	$the_file_3 =$the_file_3 .'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><img  class="img-responsive img-thumbnail" src="resourcefile/News_Files/'.$row_two_in['news_id']."/".$picky.'" /></div>';
																	$the_file_3 =$the_file_3.'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >'.$my_file_two.'</div>';
																}
															}
														}
																		
													}
													echo $the_file_3;
								
												}
									
						
						?>
					</div>
					
				</div>
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:grey">
					<p style="text-align:center;color:yellow;">Copyright &copy; 2017 - All Rights Reserved - Software Development Unit, A S A.</p>
				</div>
				</footer>
	</div>