<?php 
include_once "../../db.php";
 $bno = mysqli_real_escape_string($db, $_GET["idx"]);
 
 $sql_load = mysqli_query($db, "select * from board where idx='".$bno."'"); 

 while($board = $sql_load->fetch_array()) {
     $writer = $board["userid"];
 }

 if($writer == $_SESSION["userid"]) {
    echo "<script>alert('자기 자신은 차단이 불가합니다.');history.back();</script>";
 }else{
    $sql = mysqli_query($db, "insert into block(blockid,userid) values('".$writer."','".$_SESSION['userid']."')");
    echo "<script>alert('차단이 완료되었습니다. 더이상 이 작성자가 쓴 게시물이 보이지 않습니다.');location.href='../index.php'</script>";
 }
?>