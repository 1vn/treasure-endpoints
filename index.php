<?php

include 'preheader.php';

$cmd=$_GET['cmd'];
if(!$cmd)$cmd=$_POST['cmd'];

switch($cmd){
	case 'newuser': include 'icl/newuser.inc.php'; newuser();break;
	case 'newcomment': include 'icl/newcomment.inc.php'; newcomment();break;
	case 'newitem': include 'icl/newitem.inc.php'; newitem();break;
	case 'getuserrating': include 'icl/getuserrating.inc.php'; getuserrating();break;
	case 'getuseritems': include 'icl/getuseritems.inc.php'; getuseritems();break;
	case 'getuseritem': include 'icl/getuseritem.inc.php'; getuseritem();break;
	case 'getusercomments': include 'icl/getusercomments.inc.php'; getusercomments();break;
	case 'getallusersnear': include 'icl/getallusersnear.inc.php'; getallusersnear();break;
	case 'updateitem': include 'icl/updateitem.inc.php'; updateitem();break;
	case 'deleteitem': include 'icl/deleteitem.inc.php'; deleteitem();break;
	case 'getlocalusers': include 'icl/getlocalusers.inc.php'; getlocalusers();break;
	case 'braintreectoken':include 'icl/braintreectoken.inc.php';braintreectoken();break;
	case 'braintreepay':include 'icl/braintreepay.inc.php';braintreepay();break;
	default: die('unrecognized command '.$cmd);
}