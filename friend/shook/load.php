<?php 
    include "../../db.php";
    
    $bno = $_GET["idx"];
    
    $sql_load_shook = mq("SELECT * FROM `shook` WHERE idx = '$bno'");
    while($shook = $sql_load_shook->fetch_array()) {
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include "../../include/header_down_down.php"; ?>
</head>

<body>
    <form action="process.php" method="POST">
        <div class="container" style="margin-top:12px;">

            <div class="d-flex flex-row">
                <i class="fa-solid fa-chevron-left fa-2x" style="color: white;"></i>
            </div>

            <div class="shook">
                <?php echo $shook["content"]; ?>
            </div>

            <div class="d-flex flex-row-reverse">
                <div class="p-2">
                    <button type="button" onclick="location.href='../'" class="upload">삭제</button>
                </div>
                <div class="p-2">
                    <button type="button" onclick="location.href='../'" class="upload">닫기</button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
<?php } ?>