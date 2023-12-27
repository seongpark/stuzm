<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=0">
    <title>STUZM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../../favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <form action="process.php" method="POST">
        <div class="container" style="margin-top:12px;">

            <div class="d-flex flex-row">
                <i class="fa-solid fa-chevron-left fa-2x" style="color: white;"></i>
            </div>

            <input type="text" class="shook" placeholder="짧고 간단하게 남겨보세요." required name="content">

            <div class="d-flex flex-row-reverse">

                <div class="p-2">
                    <button type="submit" style="color:black;" class="upload">게시하기</button>
                </div>
                <div class="p-2">
                    <button style="color:black;" onclick="history.back();" class="upload">뒤로가기</button>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>