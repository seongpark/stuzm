<?php 
include_once "../../db.php";
 $bno = mysqli_real_escape_string($db, $_GET["idx"]);
 
 $sql_load = mysqli_query($db, "select * from board where idx='".$bno."'"); 

 while($board = $sql_load->fetch_array()) {
     $writer = $board["userid"];
 }

 if($writer == $_SESSION["userid"]) {
    echo "<script>alert('내가 쓴 게시물은 숨길 수 없습니다!');history.back();</script>";
 }else{
    $sql = mysqli_query($db, "insert into hidden(post_idx,userid) values('".$bno."','".$_SESSION['userid']."')");
    echo "<script>alert('더이상 이 게시물이 보이지 않습니다.);location.href='../index.php'</script>";
 }
?>