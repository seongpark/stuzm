<?php 
    include "../db.php";

    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

?>
<?php
	$bno = $_GET['idx'];
	$sql = mysqli_query($db, "select * from sch_cal where idx='$bno';");
	$board = $sql->fetch_array();
 ?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>지금</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" i
        ntegrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
</head>

<body>

    <div class="container mt-5">
        <h1>수정</h1>
        <form action="edit_process.php?idx=<?php echo $bno; ?>" method="post">
            <div class="mb-3">
                <label class="form-label">이름</label>
                <input type="text" class="form-control" name="title" required value="<?php echo $board['title']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">내용</label>
                <textarea type="text" class="form-control" name="detail" required
                    value=""><?php echo $board['detail']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">날짜</label>
                <input type="date" class="form-control" name="date" required value="<?php echo $board['date']; ?>">
                </input>
            </div>
            <div class="mb-3">
                <label class="form-label">교시</label>
                <input type="number" class="form-control" name="time" required value="<?php echo $board['time']; ?>">
                </input>
            </div>
            <input type="submit" class="btn btn-primary" value="완료"></input>
        </form>
    </div>

</body>

</html>