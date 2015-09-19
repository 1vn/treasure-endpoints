<?php

function getuseritems(){
	global $db;
	$userid=$_GET['userid']+0;

	$query="select * from useritems where userid=$userid";
	$rs=sql_query($query, $db);
	$items=array();
	while($myrow=sql_fetch_assoc($rs)){
		$useritemid=$myrow['useritemid'];
		$price=$myrow['price']+0;
		$name=$myrow['name'];
		$status=$myrow['status'];

		$created_at=$myrow['created_at']+0;

		$tags=array();
		$query="select * from itemtags where useritemid=$useritemid";
		$rs1=sql_query($query, $db);
		while($myrow1=$sql_fetch_assoc($rs1)){
			$tagname=$myrow1['tagname'];
			array_push($tags, $tagname);
		}

		$images=array();
		$query="select * from itemimages where useritemid=$useritemid";
		$rs2=sql_query($query, $db);
		while($myrow2=$sql_fetch_assoc($rs2)){
			$filename=$myrow2['filename'];
			array_push($images, $filename);
		}

		$query="select * from itemimages where useritemid=$useritemid";
		array_push($items, array("useritemid"=>$useritemid, "price"=>$price, "name"=>$name, "status"=>$status, "created_at"=>$created_at, "images"=>$images, "tags"=>$tags));
	}
	echo json_encode($items);

}