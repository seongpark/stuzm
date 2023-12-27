<?php

include_once "../db.php";

$_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

if (!$_GET['img']) {
    $tmpfile = $_FILES['b_file']['tmp_name'];
    $o_name = $_FILES['b_file']['name'];
    $filename = $_SESSION['userid'] . ".png";
    $folder = "img/" . $filename;

    if (file_exists($folder)) {
        unlink($folder);
    }

    if ($_FILES['b_file']['error'] == UPLOAD_ERR_OK) {
        if (move_uploaded_file($tmpfile, $folder)) {
            $sql = mysqli_query($db, "update member set profile_image='" . $filename . "' where id='" . $_SESSION['userid'] . "'");
        } else {
            echo "<script>alert('파일 업로드에 실패했습니다.');location.href='../user'</script>";
            exit;
        }
    } else {
        echo "<script>alert('파일 업로드 중 오류가 발생했습니다. 오류 코드와 함께 STUZM으로 문의해주세요. 오류 코드: " . $_FILES['b_file']['error'] . "');location.href='../user'</script>";
        exit;
    }
}

if ($_GET['img'] == "default") {
    $sql = mysqli_query($db, "update member set profile_image='default.png' where id='" . $_SESSION['userid'] . "'");
}

echo "<script>alert('프로필 사진 설정이 완료되었습니다.');location.href='../user'</script>";
?>