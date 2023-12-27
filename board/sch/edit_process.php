<?php
include "../db.php";



$bno =  mysqli_real_escape_string($db, $_GET['idx']);

$sql2 = mysqli_query($db, "select * from sch_cal where idx='".$bno."'");

        $sql = mysqli_query($db, "update sch_cal set title='".$_POST['time']."',datail='".$_POST['detail']."',date='".$_POST['date']."',time='".$_POST['time']."' where idx='".$bno."'"); 
		echo "<script>alert('수정되었습니다.');//location.href='../index.php'</script>";

?>