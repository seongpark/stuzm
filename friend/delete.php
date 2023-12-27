<?php
	include "../db.php";

	if(isset($_SESSION['userid'])){
		$id = $_SESSION['userid'];
	}	

    $bno = mysqli_real_escape_string($db, $_GET["idx"]);

		$sql = mysqli_query($db, "delete from friend where idx='$bno';");

		echo '<script type="text/javascript">
		</script>
		<meta http-equiv="refresh" content="0 url=index.php" />';

?>