<!-- A -->
		<?php
			$date = new DateTime();
			$current_timestamp = $date->getTimestamp();
		?>
		<script>
		    flag_time = true;
			timer = '';
			setInterval(function(){phpJavascriptClock();},1000);
			
			function phpJavascriptClock()
			{
				if ( flag_time ) {
				timer = <?php echo $current_timestamp;?>*1000;
				}
				var d = new Date(timer);
				months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
				
				month_array = new Array('January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'Augest', 'September', 'October', 'November', 'December');
				
				day_array = new Array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
				
				currentYear = d.getFullYear();
				month = d.getMonth();
				var currentMonth = months[month];
				var currentMonth1 = month_array[month];
				var currentDate = d.getDate();
				currentDate = currentDate < 10 ? '0'+currentDate : currentDate;
				
				var day = d.getDay();
				current_day = day_array[day];
				var hours = d.getHours();
				var minutes = d.getMinutes();
				var seconds = d.getSeconds();
				
				var ampm = hours >= 12 ? 'PM' : 'AM';
				hours = hours % 12;
				hours = hours ? hours : 12; // the hour ’0′ should be ’12′
				minutes = minutes < 10 ? '0'+minutes : minutes;
				seconds = seconds < 10 ? '0'+seconds : seconds;
				var strTime = hours + ':' + minutes+ ':' + seconds + ' ' + ampm;
				timer = timer + 1000;
				/**document.getElementById("demo").innerHTML= currentMonth+' ' + currentDate+' , ' + currentYear + ' ' + strTime ;
				
				document.getElementById("demo1").innerHTML= currentMonth1+' ' + currentDate+' , ' + currentYear + ' ' + strTime ;
				
				document.getElementById("demo2").innerHTML= currentDate+':' +(month+1)+':' +currentYear + ' ' + strTime ;
				
				//document.getElementById("demo3").innerHTML= strTime ;**/
				
				document.getElementById("demo4").innerHTML= current_day + ' , ' +currentMonth1+' ' + currentDate+' , ' + currentYear + ' ' + strTime;
				flag_time = false;
			}

		</script>
		<div class="row" style="margin-top:10px">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<h5 style="font-family: 'Due';"><b> <a href="index.php">HOME</a> 	| <a href="#">ABOUT US</a> | <a href="#">ADVERTISE WITH US</a> | <a href="#">CONTACT US</a></b></h5>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="color:red" >
					<p style="font-weight:bold;font-family: 'Due'; color:#C77405;font-size:20px;" id="demo4"></p>
				</div>
					<hr/>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<img  class="img-responsive" src="settings/images/headlogo.jpg" />
			</div>
			<div class="hidden-xs col-sm-8 col-md-8 col-lg-8">
				<!-- <img  class="img-responsive img-thumbnail" src="resourcefile/headlogo.jpg" /> -->
			</div>
		</div>
		<!-- A CLOSE -->
		<!-- B -->
		<div class="row" style="margin-top:10px">
		
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
				<nav role="navigation" class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="index.php" class="navbar-brand">Home</a>
					</div>
					<!-- Collection of nav links, forms, and other content for toggling -->
					<div id="navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="view_more_news.php?news_c=latest">News</a></li>
							<li><a href="view_more_news.php?news_c=Sports">Sports</a></li>
							<li><a href="view_more_news.php?news_c=Politics">Politics</a></li>
							<li><a href="view_more_news.php?news_c=Business">Business</a></li>
							<li><a href="view_more_news.php?news_c=Tech">Tech</a></li>
							<li><a href="view_more_news.php?news_c=Entertainment">Entertainment</a></li>
							<li><a href="view_more_news.php?news_c=Articles">Opinion / Articles</a></li>
							<li><a href="view_more_news.php?news_c=Features / Interview">Features / Interviews</a></li>
							<li><a href="view_more_news.php?news_c=Health">Health</a></li>
							<li><a href="view_more_news.php?news_c=Relationship">Relationship</a></li>
							<li><a href="view_more_news.php?news_c=Metro">Metro</a></li>
							
						</ul>
						
						<ul class="nav navbar-nav navbar-right">
							<form role="search" class="navbar-form navbar-left" action="search_news_result.php" enctype="multipart/form-data" method="GET">
								<div class="form-group">
									<input type="text" placeholder="Search for News !" class="form-control" name="searchmail" >
								</div>
								<button type="submit" class="btn btn-default">Search</button>
							</form>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<!-- B CLOSE -->