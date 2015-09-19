<?

function getuserrating(){
	global $db;
	$userid=$_GET['userid']+0;
	$query="select * from itemcomments where useritemid in (select useritemid from useritems where userid=$userid)";
	$rs=sql_query($query, $db);
	$rowcount=sql_affected_rows($db, $rs);
	$positivity=0;
	while($myrow=sql_fetch_assoc($rs)){
		$comment=$myrow['comment'];
		$positivity+=getcommentrating($comment);
	}
	return json_encode(array("positivity"=>$positivity));
}

function getcommentrating($comment){
	$infojson=array("data"=>$comment);
	$infojson=json_encode($infojson);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "http://apiv2.indico.io/sentimenthq?key=dbca3475cd4957d804850a512472da5a",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_POST=> 1,
	CURLOPT_POSTFIELDS =>$infojson,
	CURLOPT_SSL_VERIFYHOST => 2,
	CURLOPT_HTTPHEADER=>array(
		'Content-Type: application/json'
	)
	));
	$rs=curl_exec($curl);

	return $rs;
}