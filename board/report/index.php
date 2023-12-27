<?php 
    include "../../db.php";
?>
<?php
	$bno = mysqli_real_escape_string($db, $_GET['idx']);
	$sql = mysqli_query($db, "select * from board where idx='$bno';");
	$board = $sql->fetch_array();
 ?>
<!DOCTYPE html>
<html lang="ko">
<style>
a {
    color: black !important;
}
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUZM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" i
        ntegrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
</head>

<body>
    <div class="top_back mt-3">
        <div class="container">
            <a onclick="history.back();" style="font-size: 20px;">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>
    <div class="container mt-4">
        <h1>신고하기</h1>
        <p>허위 신고 시 불이익이 있을 수 있습니다.<br>신고는 검토 후 24시간 이내 처리됩니다.</p>
        <form action="process.php?idx=<?php echo $bno; ?>" method="post">
            <div class="mb-3">
                <label class="form-label">신고 글 작성자</label>
                <input type="text" class="form-control" required value="<?php echo $board['name']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">신고 글 제목</label>
                <input type="text" class="form-control" required value="<?php echo $board['title']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">신고 글 내용</label>
                <textarea type="text" class="form-control" required disabled><?php echo $board['content']; ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">신고 사유</label>
                <textarea type="text" class="form-control" required name="reason"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" style='width:100%;' value="완료"></input>
        </form>
    </div>

</body>

</html>