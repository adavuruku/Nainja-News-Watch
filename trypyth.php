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