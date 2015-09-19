<?

function newcomment(){
	global $db;
	$useritemid=$_POST['useritemid'];
	$userid=$_POST['userid'];
	$created_at=time();
	$comment=$_POST['comment'];

	$query="insert into itemcomments (useritemid, userid, comment, created_at) values ($useritemid, $userid, '$comment', $created_at)";
	$rs=sql_query($query, $db);
	echo json_encode(array('success'=>true));
}