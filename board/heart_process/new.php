<?php
include("../../db.php");

$bno = mysqli_real_escape_string($db, $_GET["idx"]);
$userid = mysqli_real_escape_string($db, $_COOKIE["userid"]);

$sql = "INSERT INTO heart_board (userid, board_idx) VALUES ('$userid', '$bno')";

if ($db->query($sql) === TRUE) {
    echo "<script>alert('공감이 완료되었습니다.');location.href='../read.php?idx=$bno'</script>";
} else {
    echo "오류: " . $sql . "<br>" . $db->error;
}