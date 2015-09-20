<?

function getusercomments(){
	global $db;
	$userprofileid=(int)$_GET['userid'];

	$query="select * from userprofilecomments where userprofileid=$userprofileid";
	$rs=sql_query($query, $db);
	$comments=array();
	while($myrow=sql_fetch_assoc($rs)){
		$commenterid=$myrow['commenterid'];
		$comment=$myrow['comment'];
		$query="select * from users where userid=$userid";
		$rs1=sql_query($query, $db);
		$myrow1=sql_fetch_assoc($rs1);
		$commenterfname=$myrow1['fname'];
		$commenterlname=$myrow1['lname'];
		$commenterpic=$myrow1['image'];
		$created_at=$myrow["created_at"];
		array_push($comments, array("commenterid"=>$commenterid, "comment"=>$comment, "fname"=>$commenterfname, "lname"=>$commenterlname, "created_at"=>$created_at));
	}

	echo json_encode($comments);
}
