<?php
session_start(); 
require_once 'settings/connection.php';
require_once 'settings/filter.php';


	$stmt = $conn->prepare("SELECT * FROM news where category!=? ORDER BY id DESC");		
	$stmt->execute(array("Videos"));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1){
		$two = array();
		while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)){
			//$all[] = ($row2);
			
			$subj_two='';
			$subj_two = $row2['news_info'];
			$body_two = htmlspecialchars_decode($subj_two);
			$body_two= str_ireplace('<p>','',$body_two);
			$body_two= strip_tags($body_two);
			$subj_two = substr($body_two,0,300)."...";
			
			$body_two_2 = htmlspecialchars_decode($row2['news_info']);
			$body_two_2= str_ireplace('<p>','',$body_two_2);
			$body_two_2= strip_tags($body_two_2);
			
			$date500_two = new DateTime($row2['news_date']);
			$J = date_format($date500_two,'l');
			$Q = date_format($date500_two,'d F, Y  h:i:s A');
			$date_two = $J.', '.$Q;
			$author_l = null;
			if($row2['category'] =="Articles"){
				$author_l ='By : '.$row2['credited'];
			}else{
				$author_l = 'Edited By : '.$row2['author'];
			}
			
			$pics_path=null;
			$image_line = strip_tags($row2['news_id']);
			$iteratepoint = "resourcefile/News_Files/".$image_line."/";
			$dir = new DirectoryIterator($iteratepoint);
			foreach ($dir as $fileinfo) 
			{
				if (!$fileinfo->isDot()) 
				{
					$picky = $fileinfo->getFilename();
					if(substr_count($picky,"news_file") > 0){
						//$image_file = $picky;
						$pics_path = "http://192.168.230.1/NainjaNewsWatch/".$iteratepoint.$picky;
					}
				}	
			}
			
			$one = array(
				"news_head" => strtoupper($row2['category'])." News : ".$row2['news_head'],
				"author" => $author_l,
				"date_two" => $date_two,
				"news_id" => $row2['news_id'], 
				"body_two" => $subj_two,
				"pics_path" => $pics_path,
				"full_info"=>$body_two_2,
				"category"=>strtoupper($row2['category'])
			  );
			array_push($two,$one);
		}
		print(json_encode($two));
	 }
	/** $two = array();
	for(  $in = 0; $in<=4; $in++){
	 $myobj-> name = "John";
	 $myobj-> age = 30;
	 $myobj-> city = "Kano";
	 $one = array();
	 array_push($one,"blue","yellow");
	 $one = '{"id":1,"Full_Name":"Abdulraheem Sherif Adavuruku","User_Name":"admin","Password":"admin"},';
	  $one.= $one;
	 $myJSON =  (json_encode($myobj));
	  $one = array(
		"a" => "come",
		"b" => "go",
	  );
	   array_push($two,$one);
	}
	//$myJSON =  (json_encode($one));
	//print_r ($two);
	print (json_encode($two));**/
 ?>