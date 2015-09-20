<?

function getuseritem(){
	global $db;
	$useritemid=$_GET['useritemid'];
	$query="select * from useritems where useritemid=$useritemid";
	$rs=sql_query($query, $db);
	$myrow=sql_fetch_assoc($rs);
	$name=$myrow['name'];
	$price=$myrow['price'];
	$status=$myrow['status'];
	$created_at=$myrow['created_at'];
	$user_id=$myrow['user_id'];

	$item=array('name'=>$name, 'price'=>$price, 'status'=>$status, 'created_at'=>$created_at, 'user_id'=>$user_id);
	echo json_encode($item);

}