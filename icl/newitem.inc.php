<?php
define("PATH_SDK_ROOT", "v3-php-sdk-2.1.0/");
define("POPO_CLASS_PATH", "v3-php-sdk-2.1.0/Data/");
require_once('../config.php');
require_once('v3-php-sdk-2.1.0/Core/ServiceContext.php');
require_once('v3-php-sdk-2.1.0/DataService/DataService.php');
require_once('v3-php-sdk-2.1.0/PlatformService/PlatformService.php');
require_once('v3-php-sdk-2.1.0/Utility/Configuration/ConfigurationManager.php');

function newitem(){
	global $db;
	$name=$_POST['name'];
	$price=$_POST['price'];
	$userid=$_POST['userid'];
	$image=$_POST['image'];
	$created_at=time();
	$desc=$_POST['desc'];

	if($_POST['tags']){
		$tags=explode(',', $_POST['tags']);
	}
	$query="insert into useritems (name, price, userid, image, created_at, desc) values ('$name', $price, $userid, '$image', $created_at, '$desc')";
	$rs=sql_query($query, $db);
	$useritemid=sql_insert_id($db, $rs);

	if($tags){
		foreach($tags as $tag){
			$query="insert into itemtags (useritemid, tagname) values ($useritemid, $tag)";
			$rs=sql_query($query, $db);
		}
	}

	if($_SESSION['secret']){
		$reqbody=array();
		$requestValidator = new OAuthRequestValidator($_SESSION[], '', '', '');
		$realmid=$_SESSION['realmId'];
		$serviceType= IntuitServicesType::QBD;
		$serviceContext = new ServiceContext($realmId, $serviceType, $requestValidator);
		$dataService = new DataService($serviceContext);
		$itemObj = new IPPitem();
		$itemObj->Name = $name;
		$itemObj->Desc = $desc;
		$itemObj->Price = $price;
		$itemObj->Id=$useritemid;
		$itemObj->Img=$image;
		echo $entities;

	}

  	$error=array();
    $extension=array("jpeg","jpg","png","gif");
	if($_FILES['files']){
		foreach($_FILES['files']['tmp_name'] as $key=>$tmp_name){
			$file_name=$_FILES["files"]["name"][$key];
			$file_tmp=$_FILES['files']['tmp_name'][$key];
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);
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