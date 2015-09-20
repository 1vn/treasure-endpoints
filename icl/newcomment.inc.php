<?php

function newcomment(){
	global $db;
	$userid=$_POST['userid'];
	$commenterid=$_POST['commenterid'];
	$created_at=time();
	$comment=$_POST['comment'];

	$query="insert into userprofilecomments (userid, commenterid, comment, created_at) values ($userid, $commenterid, '$comment', $created_at)";
	$rs=sql_query($query, $db);
	echo json_encode(array('success'=>true));
}