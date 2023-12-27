<?php
	include "../../db.php";

	if(isset($_SESSION['userid'])){
		$id = $_SESSION['userid'];
	}	
	
	$bno = $_GET['idx'];

	$sql3 = mysqli_query($db, "select * from board_sch where idx='".$bno."'"); 
	
while($board = $sql3->fetch_array()) {
	$writer = $board["userid"];
}

if($id == $writer) {
	$sql = mysqli_query($db, "delete from board_sch where idx='$bno';");
	$sql = mysqli_query($db, "delete from reply_sch where con_num='$bno';");

	echo '<script type="text/javascript">
	alert("삭제되었습니다.");
	</script>
	<meta http-equiv="refresh" content="0 url=../index.php" />';
}else {
	echo '<script type="text/javascript">
	alert("비정상적인 접근입니다.");history.back();
	</script>';
}

?>