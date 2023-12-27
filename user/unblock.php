<?php 
    include "../db.php";
    
    $bno = $_GET["idx"];

    $sql = mq("delete from block where idx='$bno';");

    echo '<script type="text/javascript">
		alert("차단이 해제되었습니다.");
		</script>
		<meta http-equiv="refresh" content="0 url=block.php" />';

?>