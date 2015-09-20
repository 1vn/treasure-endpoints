<?php

function getusers(){
	global $db;
	$query="select * from users";
	$rs=sql_query($query, $db);
	$users=array();
	while($myrow=sql_fetch_assoc($rs)){
		$fname=$myrow['fname'];
		$lname=$myrow['lname'];
		$image=$myrow['image'];
		$userid=$myrow['userid'];
		$query="select * from useritems where userid=$userid limit 4";
		$itemrs=sql_query($query, $db);
		$items=array();
		while($itemrow=sql_fetch_assoc($itemrs)){
			$useritemid=$itemrow['useritemid'];
			$itemimage=$itemrow['image'];
			$created_at=$itemrow['created_at'];
			$status=$itemrow['status'];
			array_push($items, array("useritemid"=>$useritemid, "image"=>$itemimage, "created_at"=>$created_at, "status"=>$status));
		}
		array_push($users, array("fname"=>$fname, "lname"=>$lname, "image"=>$image, "userid"=>$userid, "items"=>$items));
	}

	echo json_encode($users);
}