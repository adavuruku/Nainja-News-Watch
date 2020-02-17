<?php
//update
session_start();
require_once '../settings/connection.php';
require_once '../settings/filter.php';


if(isset($_POST['delete_item_2']))
{
	$Add_Id = $_POST['goods_id'];
	$goods_name = $_POST['goods_name'];
	//update the quantity
	$stmt = $conn->prepare("UPDATE news SET status= ? WHERE news_id=? AND status=?");
	$stmt->execute(array("1",$Add_Id,""));
	$affected_rows = $stmt->rowCount();
	echo $goods_name;
}

if(isset($_POST['like_news']))
{
	$Add_Id = $_POST['news_id'];
	//update the quantity
	$stmt = $conn->prepare("UPDATE news SET no_like = no_like + 1 WHERE news_id=? Limit 1");
	$stmt->execute(array($Add_Id));

	$stmt_ina = $conn->prepare("SELECT no_like,news_id FROM news where news_id =? Limit 1");
	$stmt_ina->execute(array($Add_Id));
	$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
	echo $row_two['no_like'];
}

if(isset($_POST['like_comment']))
{
	$Add_Id = $_POST['news_id'];
	//update the quantity
	$stmt = $conn->prepare("UPDATE news_comment SET like_post = like_post + 1 WHERE comment_id=? Limit 1");
	$stmt->execute(array($Add_Id));

	$stmt_ina = $conn->prepare("SELECT like_post,comment_id FROM news_comment where comment_id =? Limit 1");
	$stmt_ina->execute(array($Add_Id));
	$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
	echo $row_two['like_post'];
}

if(isset($_POST['like_comment_reply']))
{
	$Add_Id = $_POST['news_id'];
	//update the quantity
	$stmt = $conn->prepare("UPDATE news_reply SET like_reply = like_reply + 1 WHERE reply_id=? Limit 1");
	$stmt->execute(array($Add_Id));

	$stmt_ina = $conn->prepare("SELECT like_reply,reply_id FROM news_reply where reply_id =? Limit 1");
	$stmt_ina->execute(array($Add_Id));
	$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
	echo $row_two['like_reply'];
}
?>