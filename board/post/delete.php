<?php
	include "../../db.php";

	if(isset($_SESSION['userid'])){
		$id = $_SESSION['userid'];
	}	
	
	$bno = mysqli_real_escape_string($db, $_GET['idx']);
	$sql2 = mysqli_query($db, "select * from board where idx='".$bno."'");


	$sql3 = mysqli_query($db, "select * from board where idx='".$bno."'"); 
while($board = $sql3->fetch_array()) {
	$writer = $board["userid"];
}

if($id == $writer) {
	$sql = mysqli_query($db, "delete from board where idx='$bno';");
	$sql = mysqli_query($db, "delete from reply where con_num='$bno';");

	echo '<script type="text/javascript">
	</script>
	<meta http-equiv="refresh" content="0 url=../index.php" />';
}else {
	echo '<script type="text/javascript">
	alert("비정상적인 접근입니다.");history.back();
	</script>';
}


?>