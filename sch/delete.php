<?php
	include "../db.php";

    $bno = htmlentities($_GET["idx"]);

		$sql = mysqli_query($db, "delete from sch_cal where idx='$bno';");
		

		echo '<script type="text/javascript">
		</script>
		<meta http-equiv="refresh" content="0 url=../index.php" />';
?>