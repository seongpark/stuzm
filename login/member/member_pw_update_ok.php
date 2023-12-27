<meta charset="utf-8" />
<?php

include "../../db.php";
include "../password.php";

$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

$sql = mysqli_query($db, "update member set pw='".$userpw."' where id = '".$_SESSION['userid']."'");
session_destroy();
echo "<script>alert('비밀번호를 변경했습니다. 다시 로그인 해주세요.'); location.href='../../';</script>";

?>