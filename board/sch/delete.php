<?php
	include "../db.php";

    $bno = $_GET["idx"];

		$sql = mysqli_query($db, "delete from sch_cal where idx='$bno';");
		

		echo '<script type="text/javascript">
		alert("삭제되었습니다.");
		</script>
		<meta http-equiv="refresh" content="0 url=../index.php" />';
?>