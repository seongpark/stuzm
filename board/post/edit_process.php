<?php
include "../../db.php";

if(isset($_SESSION['userid'])){
    $id = $_SESSION['userid'];
}


$bno = mysqli_real_escape_string($db, $_GET['idx']);
$title = mysqli_real_escape_string($db, $_POST['title']);
$content = mysqli_real_escape_string($db, $_POST['content']);

$sql2 = mysqli_query($db, "select * from board where idx='".$bno."'");

$sql3 = mysqli_query($db, "select * from board where idx='".$bno."'"); 
while($board = $sql3->fetch_array()) {
	$writer = $board["userid"];
}

if($id == $writer) {
	$sql = mysqli_query($db, "update board set title='".$title."',content='".$content."' where idx='".$bno."'"); 
	echo '<meta http-equiv="refresh" content="0 url=../read.php?idx='.$bno.'">';
}else {
	echo '<script type="text/javascript">
	alert("비정상적인 접근입니다.");history.back();
	</script>';
}


?>