<?php
    include "../db.php";

    $code = mysqli_real_escape_string($db, $_POST['code']);
    $userid = mysqli_real_escape_string($db, $_COOKIE["userid"]);
    $date = date("Y-m-d");

    //기존에 값 가지고 있는지 여부 확인용
    $sql = mysqli_query($db,"select * from student_id where userid='$userid'");
    $already_have = false; //$already_have 변수에 값 가지고 있는지 여부 저장

    while ($student_id = mysqli_fetch_array($sql)) {
        $already_have = true;
    }

    //만약 기존에 값을 가지고 있다면
    if($already_have == true) {
        //기존 가지고 있던 값 삭제 
        $deleteStmt = mysqli_prepare($db, "DELETE FROM student_id WHERE userid = ?");
        mysqli_stmt_bind_param($deleteStmt, "s", $userid);
        mysqli_stmt_execute($deleteStmt);
        mysqli_stmt_close($deleteStmt);    

        //SQL문 추가
        $stmt = mysqli_prepare($db, "INSERT INTO student_id (value, date, userid) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $code, $date, $userid);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
    }

    //기존에 값을 가지고 있지 않다면
    if (!$already_have) {
        //SQL문으로 바로 추가
        $stmt = mysqli_prepare($db, "INSERT INTO student_id (value, date, userid) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $code, $date, $userid);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
    }

    //이동
    echo '<script>location.href="index.php"</script>';