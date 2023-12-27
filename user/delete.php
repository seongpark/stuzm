<?php 
    include "../db.php";
    
    if(isset($_COOKIE['userid'])){
        $id = $_COOKIE['userid'];
        
        $sql3 = mysqli_query($db, "select * from member where id='{$id}'");
        $member = $sql3->fetch_array();
        
        if($member["id"] == $_COOKIE["id"]) {
            if($member["pw"] == $_COOKIE["pw"]) {
                $sql = mysqli_query($db, "delete from member where id='$id';");
    $sql = mysqli_query($db, "delete from alert where userid='$id';");
    $sql = mysqli_query($db, "delete from ask where userid='$id';");
    $sql = mysqli_query($db, "delete from block where userid='$id';");
    $sql = mysqli_query($db, "delete from board where userid='$id';");
    $sql = mysqli_query($db, "delete from board_sch where userid='$id';");
    $sql = mysqli_query($db, "delete from exam where userid='$id';");
    $sql = mysqli_query($db, "delete from exam_mogo where userid='$id';");
    $sql = mysqli_query($db, "delete from friend where userid='$id';");
    $sql = mysqli_query($db, "delete from friend where friend_id='$id';");
    $sql = mysqli_query($db, "delete from group_coin where userid='$id';");
    $sql = mysqli_query($db, "delete from group_market where userid='$id';");
    $sql = mysqli_query($db, "delete from market_buy where buyer='$id';");
    $sql = mysqli_query($db, "delete from pw_code where userid='$id';");
    $sql = mysqli_query($db, "delete from reply where userid='$id';");
    $sql = mysqli_query($db, "delete from reply_sch where userid='$id';");
    $sql = mysqli_query($db, "delete from shook where userid='$id';");
    $sql = mysqli_query($db, "delete from study_log where userid='$id';");

    $expire_time = time() - 3600;
    setcookie('userid', '', $expire_time, '/');
    setcookie('userpw', '', $expire_time, '/');

    echo "<script>alert('회원 탈퇴가 완료되었습니다.');location.href='../login'</script>";
    session_destroy();
            }
        }
    }
?>