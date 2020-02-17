<?php
require_once 'settings/connection.php';
	$opr = urldecode($_POST['opr']);
	$err=null;
	$two = $one = array();
	$searchQuery ="";
	
//login code
if($opr=="login"){
	
	$username = urldecode($_POST['email']);$password = urldecode($_POST['password']);
	$stmt = $conn->prepare("SELECT * FROM viewers where email =? and userPas =? Limit 1");		
	$stmt->execute(array($username,$password));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1){
		$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
		$one = array(
			"Error" => "None",
			"MyName" => $row2['fullName'],
			"MyEmail" => $row2['email'],
			"MyGender" => $row2['gender'],
			"MyPermAdd" => $row2['permAdd'], 
			"MyState" => $row2['Userstate'],
			"MyPics" => "http://192.168.43.70/NainjaNewsWatch/profile/".$row2['UserID'],
			"MyPassword"=>$row2['userPas'],
			"MyPhone"=>$row2['UserPhone']
		  );
	}else{
		$one = array("Error" => "Error: Wrong Username Or Password !!!");
	}
	print(json_encode($one));
}	
	
if($opr=="changePics"){
	$username = $_POST['userMail'];$encoded_string = $_POST['newPics'];;
	$decoded_string = base64_decode($encoded_string);
	
	$stmt = $conn->prepare("SELECT * FROM viewers where email =? Limit 1");		
	$stmt->execute(array($username));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1){
		$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
		$folder_name = $row2['UserID'];
		$path = 'profile/'.$folder_name;
		if(file_put_contents($path,$decoded_string)){
				echo "Successfully Changed !!!";
		}else{
			echo "Error: Fail To Upload Photo !!!";
		}
	}
}

if($opr=="changePassword"){
	$username = urldecode($_POST['userMail']);$password = urldecode($_POST['newPassword']);
	$stmt = $conn->prepare("UPDATE viewers set userPas=? WHERE email=? Limit 1");		
	if($stmt->execute(array($password,$username))){
		$err = "Successfully Updated !!!";
	}else{
		$err = "Error - Fail To Update / Change Password !!!";
	}
	echo $err;
}


//save news
	if($opr=="UploadNews"){
	
		$newsDetails = urldecode($_POST['newsDetails']);$newsDesc = urldecode($_POST['newsDesc']);$newsID = urldecode($_POST['newsID']);
		$newsType = urldecode($_POST['newsType']);$newsEmail = urldecode($_POST['newsEmail']);$encoded_string = $_POST['encoded_string'];
		
		$decoded_string = base64_decode($encoded_string);
		
		$folder_name = $newsID.'.jpg';
		$path = 'profile/news/'.$folder_name;
		if(file_put_contents($path,$decoded_string)){ 	 	 	 	 	 	
			$sth = $conn->prepare ("INSERT INTO viewers_news (newsEmail,newsData,newsLocation,newsID,newsType,newsPics,newsDate)
																VALUES (?,?,?,?,?,?,now())");																
				$sth->bindValue (1, $newsEmail);
				$sth->bindValue (2, $newsDetails);
				$sth->bindValue (3, $newsDesc);
				$sth->bindValue (4, $newsID);
				$sth->bindValue (5, $newsType);
				$sth->bindValue (6, $folder_name);
				if($sth->execute()){
					$err = "Record Saved";
				}else{
					$err = "Error - Fail To not Record !!!";
				}
		}else{
					$err = "Error - Fail To Saved Record !!!";
		}
		echo $err;	
	}
//save news
	if($opr=="UploadVideo"){
		$encoded_string = $_POST['encoded_string'];
		
		$decoded_string = base64_decode($encoded_string);
		
		$folder_name = 'myVideo2'.'.mp4';
		$path = 'profile/news/'.$folder_name;
		if(file_put_contents($path,$decoded_string)){ 	 	 	 	 	 	
			/**$sth = $conn->prepare ("INSERT INTO viewers_news (newsEmail,newsData,newsLocation,newsID,newsType,newsPics,newsDate)
																VALUES (?,?,?,?,?,?,now())");																
				$sth->bindValue (1, $newsEmail);
				$sth->bindValue (2, $newsDetails);
				$sth->bindValue (3, $newsDesc);
				$sth->bindValue (4, $newsID);
				$sth->bindValue (5, $newsType);
				$sth->bindValue (6, $folder_name);
				if($sth->execute()){
					$err = "Record Saved";
				}else{
					$err = "Error - Fail To not Record !!!";
				}**/
				$err = "Record Saved";
		}else{
					$err = "Error - Fail To Saved Record !!!";
		}
		echo $err;	
	}

//save user account
	if($opr=="new"){
		$fullname = urldecode($_POST['fullname']);$username = urldecode($_POST['username']);$gender = urldecode($_POST['gender']);$userpermAdd = urldecode($_POST['userpermAdd']);
		$userphone = urldecode($_POST['userphone']);$userPassword = urldecode($_POST['userPassword']);$userState = urldecode($_POST['userState']);
		$encoded_string = $_POST['encoded_string'];
		
		$decoded_string = base64_decode($encoded_string);
		
		$folder_name = mt_rand(243202409,263604334);
		$folder_name .= mt_rand(047100,961604);
		
		$folder_name = $folder_name.'.jpg';
		$path = 'profile/'.$folder_name;
		
		//$file = fopen($path,'wb');
		//$is_written  = fwrite($file,$decoded_string);
		//fclose($file);
		//if($is_written  > 0 ){
		if(file_put_contents($path,$decoded_string)){
			$sth = $conn->prepare ("INSERT INTO viewers (fullName,email,gender,permAdd,Userstate,userPas,UserID,UserPhone)
																VALUES (?,?,?,?,?,?,?,?)");																
				$sth->bindValue (1, $fullname);
				$sth->bindValue (2, $username);
				$sth->bindValue (3, $gender);
				$sth->bindValue (4, $userpermAdd);
				$sth->bindValue (5, $userState);
				$sth->bindValue (6, $userPassword);
				$sth->bindValue (7, $folder_name);
				$sth->bindValue (8, $userphone);
				if($sth->execute()){
					$err = "Record Saved";
				}else{
					$err = "Error - Fail To not Record !!!";
					//$err = $fullname.$username.$gender.$userpermAdd.$userphone.$userPassword.$userState.$folder_name;
				}
		}else{
					$err = "Error - Fail TRY Saved Record !!!";
					//$err = $fullname.$username.$gender.$userpermAdd.$userphone.$userPassword.$userState.$folder_name;
		}
		echo $err;
		
	}  
	//$opr = "latest";
	if($opr=="sports"){
			$stmt = $conn->prepare("SELECT * FROM news where category =? ORDER BY id DESC");		
			$stmt->execute(array("Sports"));
			$affected_rows = $stmt->rowCount();
			if($affected_rows >= 1){
			$two== array();
			while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($row2['category'] =="Articles"){
					$author_l ='By : '.$row2['credited'];
				}else{
					$author_l = 'Edited By : '.$row2['author'];
				}
				set_values($row2['category'], $row2['news_info'], $author_l,$row2['news_date'],$row2['news_id'],$row2['news_head']);
			}
			print(json_encode($two));
		}
	}

	if($opr=="search"){
			$searchQuery = urldecode($_POST['searchQuery']);
			//$searchQuery="Politics";
			$stmt = $conn->prepare("SELECT * FROM news where category =? ORDER BY id DESC");		
			$stmt->execute(array($searchQuery));
			$affected_rows = $stmt->rowCount();
			if($affected_rows >= 1){
			$two== array();
			while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($row2['category'] =="Articles"){
					$author_l ='By : '.$row2['credited'];
				}else{
					$author_l = 'Edited By : '.$row2['author'];
				}
				set_values($row2['category'], $row2['news_info'], $author_l,$row2['news_date'],$row2['news_id'],$row2['news_head']);
			}
			print(json_encode($two));
		}
	}

	//articles
	if($opr=="articles"){
			$stmt = $conn->prepare("SELECT * FROM news where category =? ORDER BY id DESC");		
			$stmt->execute(array("Articles"));
			$affected_rows = $stmt->rowCount();
			if($affected_rows >= 1){
			$two== array();
			while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($row2['category'] =="Articles"){
					$author_l ='By : '.$row2['credited'];
				}else{
					$author_l = 'Edited By : '.$row2['author'];
				}
				set_values($row2['category'], $row2['news_info'], $author_l,$row2['news_date'],$row2['news_id'],$row2['news_head']);
			}
			print(json_encode($two));
		}
	}

	//others

	if($opr=="others"){
			$stmt = $conn->prepare("SELECT * FROM news where (category !=? AND category !=?) AND (category !=? AND category !=?) ORDER BY id DESC");		
			$stmt->execute(array("Articles","Politics","Sports","Videos"));
			$affected_rows = $stmt->rowCount();
			if($affected_rows >= 1){
			$two== array();
			while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($row2['category'] =="Articles"){
					$author_l ='By : '.$row2['credited'];
				}else{
					$author_l = 'Edited By : '.$row2['author'];
				}
				set_values($row2['category'], $row2['news_info'], $author_l,$row2['news_date'],$row2['news_id'],$row2['news_head']);
			}
			print(json_encode($two));
		}
	}

	//politics
	if($opr=="politics"){
			$stmt = $conn->prepare("SELECT * FROM news where category =? ORDER BY id DESC");		
			$stmt->execute(array("Politics"));
			$affected_rows = $stmt->rowCount();
			if($affected_rows >= 1){
			$two== array();
			while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($row2['category'] =="Articles"){
					$author_l ='By : '.$row2['credited'];
				}else{
					$author_l = 'Edited By : '.$row2['author'];
				}
				set_values($row2['category'], $row2['news_info'], $author_l,$row2['news_date'],$row2['news_id'],$row2['news_head']);
			}
			print(json_encode($two));
		}
	}
	
	//Videos
	if($opr=="Videos"){
			$stmt = $conn->prepare("SELECT * FROM news where category =? ORDER BY id DESC");		
			$stmt->execute(array("Videos"));
			$affected_rows = $stmt->rowCount();
			if($affected_rows >= 1){
			$two== array();
			while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				if($row2['category'] =="Articles"){
					$author_l ='By : '.$row2['credited'];
				}else{
					$author_l = 'Edited By : '.$row2['author'];
				}
				set_values($row2['category'], $row2['news_info'], $author_l,$row2['news_date'],$row2['news_id'],$row2['news_head']);
			}
			print(json_encode($two));
		}
	}
	
	
	function set_values($category,$body,$author,$date500,$news_Id,$newHead){
		global $two;
		$subj_two='';
		$subj_two = $body;
		$body_two = htmlspecialchars_decode($subj_two);
		$body_two= str_ireplace('<p>','',$body_two);
		$body_two= strip_tags($body_two);
		$subj_two = substr($body_two,0,300)."...";
		
		$body_two_2 = htmlspecialchars_decode($body);
		$body_two_2= str_ireplace('<p>','',$body_two_2);
		$body_two_2= strip_tags($body_two_2);
		
		$date500_two = new DateTime($date500);
		$J = date_format($date500_two,'l');
		$Q = date_format($date500_two,'d F, Y  h:i:s A');
		$date_two = $J.', '.$Q;
		
		$pics_path=null;
		$image_line = strip_tags($news_Id);
		$iteratepoint = "resourcefile/News_Files/".$image_line."/";
		$dir = new DirectoryIterator($iteratepoint);
		foreach ($dir as $fileinfo) 
		{
			if (!$fileinfo->isDot()) 
			{
				$picky = $fileinfo->getFilename();
				if(substr_count($picky,"news_file") > 0){
					//$image_file = $picky;
					$pics_path = "http://192.168.43.70/NainjaNewsWatch/".$iteratepoint.$picky;
				}
				if($category =="Videos"){
					if(substr_count($picky,"news_file") <= 0){
						$pics_path = "http://192.168.43.70/NainjaNewsWatch/".$iteratepoint.$picky;
					}
				}
			}	
		}
		$one = array(
			"news_head" => strtoupper($category)." News : ".$newHead,
			"author" => $author,
			"date_two" => $date_two,
			"news_id" => $news_Id, 
			"body_two" => $subj_two,
			"pics_path" => $pics_path,
			"full_info"=>$body_two_2,
			"category"=>strtoupper($category)
		  );
		array_push($two,$one);
	}
 ?>