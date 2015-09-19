<?php

function newitem(){
	global $db;
	$itemname=$_POST['itemname'];
	$price=$_POST['price'];
	$userid=$_POST['userid'];

	$tags=explode(',', POSTSTR('tags'));

	$query="insert into useritems (itemname, price, userid) values ('$itemname', $price, $userid)";
	$rs=sql_query($query, $db);
	$useritemid=sql_insert_id($db, $rs);

	foreach($tags as $tag){
		$query="insert into itemtags (useritemid, tagname) values ($useritemid, $tag)";
		$rs=sql_query($query, $db);
	}
  	
  	$error=array();
    $extension=array("jpeg","jpg","png","gif");
	if($_FILES['files']){
		foreach($_FILES['files']['tmp_name'] as $key=>$tmp_name){
			$file_name=$_FILES["files"]["name"][$key];
			$file_tmp=$_FILES['files']['tmp_name'][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);
			if(in_array($ext,$extension)){
				if(!file_exists("itemimages/".$txtGalleryName."/".$file_name)){
                    $newFileName=$useritemid.".".$ext;
                    move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"itemimages/".$newFileName);
               		$query="insert into itemimages (useritemid, filename) values ($useritemid, '$newFileName')";
               		$rs=sql_query($query, $db);
                } else{
                    $filename=basename($file_name,$ext);
                    $newFileName=$useritemid.time().".".$ext;
                    move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"itemimages/".$newFileName);
                	$query="update itemimages set status=0 where useritemid=useritemid and status=1";
                	$rs=sql_query($query, $db);
                	$query="insert into itemimages (useritemid, filename) values ($useritemid, '$newFileName')";
                	$rs=sql_query($query, $db);
                }
			}
		}
	}

	echo json_encode(array('success'=>true));
}