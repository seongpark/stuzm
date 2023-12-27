<?php
include "../../db.php";

        $bno = mysqli_real_escape_string($db,$_GET['idx']);
        $read = mysqli_real_escape_string($db,$_GET['read']);
        $content = mysqli_real_escape_string($db,$_POST['content']);

        $sql3 = mysqli_query($db, "select * from reply_sch where idx='".$bno."'"); 
while($reply = $sql3->fetch_array()) {
    $writer = $reply["userid"];
}

if($id == $writer) {
        $sql = mysqli_query($db, "update reply_sch set content='".$content."' where idx='".$bno."'");
        echo "<script>alert('댓글이 수정되었습니다.'); location.href='../read_sch.php?idx=".$read."';</script>";
}else {
	echo '<script type="text/javascript">
	alert("비정상적인 접근입니다.");history.back();
	</script>';
}
        

?>