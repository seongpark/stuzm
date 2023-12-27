<?php
include "../../db.php";

if(isset($_SESSION['userid'])){
    $id = $_SESSION['userid'];
}	

$bno = mysqli_real_escape_string($db, $_GET['idx']); 
$read = mysqli_real_escape_string($db, $_GET['read']);

$sql3 = mysqli_query($db, "select * from reply where idx='".$bno."'"); 
while($reply = $sql3->fetch_array()) {
    $writer = $reply["userid"];
}

if($id == $writer) {
    $sql = mysqli_query($db, "delete from reply where idx='$bno';");
        echo "<script>alert('댓글이 삭제되었습니다.'); location.href='../read.php?idx=".$read."';</script>";
}else {
	echo '<script type="text/javascript">
	alert("비정상적인 접근입니다.");history.back();
	</script>';
}

?>