<?php
	include "../db.php";

	if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
        echo "<script>location.href='login';</script>"; 
        }

    $bno = mysqli_real_escape_string($db, $_GET["idx"]);

		$sql = mysqli_query($db, "delete from alert where idx='$bno';");
		
		$sql4 = mysqli_query($db, "update member set alert_read='0' where id='".$userid."'"); 

		echo '<script type="text/javascript">
		alert("삭제되었습니다.");
		</script>
		<meta http-equiv="refresh" content="0 url=index.php" />';

        ?>