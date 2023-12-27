<?php 
    include "../../db.php";
?>
<?php
	$bno = $_GET['idx'];
	$sql = mysqli_query($db, "select * from board_sch where idx='$bno';");
	$board = $sql->fetch_array();
 ?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" i
        ntegrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
</head>

<body>

    <div class="container mt-5">
        <h1>글 수정</h1>
        <form action="edit_process.php?idx=<?php echo $bno; ?>" method="post">
            <div class="mb-3">
                <label class="form-label">제목</label>
                <input type="text" class="form-control" name="title" required value="<?php echo $board['title']; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">내용</label>
                <textarea type="text" class="form-control" name="content" required
                    value=""><?php echo $board['content']; ?></textarea>
            </div>
            <input type="submit" class="btn btn-primary" value="완료"></input>
        </form>
    </div>

</body>

</html>