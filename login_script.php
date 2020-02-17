<?php
session_start(); 
require_once 'settings/connection.php';
require_once 'settings/filter.php';

$opr = urldecode($_POST['opr']);
$err=null;
if($opr=="Insert"){
$name   = urldecode($_POST['name']);
$full_name = urldecode($_POST['full_name']);
$user = urldecode($_POST['password']);
$sth = $conn->prepare ("INSERT INTO admin_user (Full_Name,User_Name,Password)
														VALUES (?,?,?)");																
					$sth->bindValue (1, $full_name);
					$sth->bindValue (2, $name);
					$sth->bindValue (3, $user);
					if($sth->execute()){
						$err = "Record Saved - Successfully !!!";
					}else{
						$err = "Error - Fail To Saved Record !!!";
					}
		echo $err;
  }   

if($opr=="Select"){
$name = urldecode($_POST['name']);
$user = urldecode($_POST['password']);
$stmt = $conn->prepare("SELECT * FROM admin_user WHERE User_Name=? and Password=? Limit 1");		
	$stmt->execute(array($name,$user));
	$affected_rows = $stmt->rowCount();
	if($affected_rows >= 1){
		$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
		$err = "You are Welcome - ".$row2['Full_Name']." !!!";
	}else{
		$err = "Error - Fail To Login Record !!!";
	}
	echo $err;
 } 

if($opr=="Update"){
$name = urldecode($_POST['name']);
$user = urldecode($_POST['password']);
$full_name = urldecode($_POST['full_name']);

$stmt = $conn->prepare("UPDATE admin_user set Full_Name=?,Password=? WHERE User_Name=? Limit 1");		
	//$stmt->execute(array($full_name,$user,$name));
	//$affected_rows = $stmt->rowCount();
	if($stmt->execute(array($full_name,$user,$name))){
		$err = "Hey - ".$full_name.", Your Record Was Updated Successfully !!!";
	}else{
		$err = "Error - Fail To Update Record !!!";
	}
	echo $err;
}

if($opr=="Delete"){
$name = urldecode($_POST['name']);
$user = urldecode($_POST['password']);
$stmt = $conn->prepare("DELETE FROM admin_user WHERE User_Name=? and Password=? Limit 1");		
	if($stmt->execute(array($name,$user))){
		$err = "Hey - ".$name.", Record Was Removed Successfully !!!";
	}else{
		$err = "Error - Fail To Delete Record !!!";
	}
	echo $err;
 }  
       /** print " ==== Record Saved =====
        Full Name  : $full_name
		User Name  : $name 
        Password  : $user";**/
?>