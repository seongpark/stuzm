<?php
include("../../db.php");

$bno = mysqli_real_escape_string($db, $_GET["idx"]);
$userid = mysqli_real_escape_string($db, $_COOKIE["userid"]);

$sql = "DELETE FROM heart_board WHERE board_idx = '$bno' and userid = '$userid'";

if ($db->query($sql) === TRUE) {
    echo "<script>alert('공감이 취소되었습니다.');location.href='../read.php?idx=$bno'</script>";
}
?>
