<?php
include "../../db.php";

if(isset($_SESSION['userid'])){
    $id = $_SESSION['userid'];
}


$bno = $_GET['idx'];
$title = $_POST['title'];
$content = $_POST['content'];

$sql3 = mysqli_query($db, "select * from board_sch where idx='".$bno."'"); 
	
while($board = $sql3->fetch_array()) {
	$writer = $board["userid"];
}

if($id == $writer) {
    $sql = mysqli_query($db, "update board_sch set title='".$title."',content='".$content."' where idx='".$bno."'"); 
    echo "<script>alert('수정되었습니다.');</script>";
    echo '<meta http-equiv="refresh" content="0 url=../read_sch.php?idx='.$bno.'">';
}else {
	echo '<script type="text/javascript">
	alert("비정상적인 접근입니다.");history.back();
	</script>';
}



?>