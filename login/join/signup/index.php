<?php 
if($_POST['type']=="student") {
    echo "<script>location.href = '../student';</script>";
}
if($_POST['type']=="teacher") {
    echo "<script>location.href = '../teacher';</script>";
}

?>