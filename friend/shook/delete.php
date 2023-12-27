<?php
	include "../../db.php";



    $bno = mysqli_real_escape_string($db, $_GET["idx"]);

		$sql = mq("delete from shook where idx='$bno';");

		echo '<script type="text/javascript">
		alert("삭제되었습니다.");
		</script>
		<meta http-equiv="refresh" content="0 url=../index.php" />';

?>