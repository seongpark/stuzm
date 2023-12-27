    <?php 
        include "../db.php";
        include "../include/header_down.php";

        //바코드 생성 함수
        function generateBarcode($text, $outputFile)
        {
            $barcodeWidth = 300;
            $barcodeHeight = 150;
            
            $image = imagecreate($barcodeWidth, $barcodeHeight);
            
            $black = imagecolorallocate($image, 0, 0, 0);
            
            imagestring($image, 5, 10, 10, $text, $black);
            
            imagepng($image, $outputFile);
            
            imagedestroy($image);
        }

        $sql = mysqli_query($db, "select * from member where id='{$_COOKIE['userid']}' and pw='{$_COOKIE['userpw']}'");
        $member = mysqli_fetch_array($sql);
    ?>

<style type="text/css">
  .barcode-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70px;
  }

  .space { background: #FFFFFF; float: left; margin: 0; padding: 0; cursor: default; }
  .bar { background: #000000; float: left; margin: 0; padding: 0; cursor: default; }
  .bartext {
    clear: both;
    font-family: Fixedsys, Arial;
    font-size: 12px;
    cursor: default;
    text-align: center; /* 가운데 정렬을 위한 스타일 추가 */
    width: 100%; /* 가로 폭을 100%로 설정 */
  }
</style>
    <script type="text/javascript" src="../assets/script/barcode.js"></script>
    </head>

    <body>
        <div id="first_container">
            <div class="back_btn">
                <a href="../">&#xE000;</a>
            </div>

            <?php 
                $sql = mysqli_query($db, "select * from student_id where userid='{$_COOKIE['userid']}'");
                $already_have = false;

                while ($student_id = mysqli_fetch_array($sql)) {
                    $already_have = true;
            ?>

            <!-- 이미 학생증이 등록되었다면 바로 표시 -->
            <center>
                <h1><?php echo $member["name"]; ?></h3>
                    <p><?php echo $member["school"]; ?></p>
                    <br>
                    <p><b>아래 바코드를 스캔해주세요.</b></p>

                    <script type="text/javascript">


                    </script>

<div class="barcode-container">
  <script type="text/javascript">
    barcode("<?php echo $student_id["value"]; ?>", 50, 2, 5, 2, 3, "000000", "FFFFFF");
  </script>
</div>
<center>
<?php echo $student_id["value"]; ?>
  </center>
  <br>  <br>
                <p style="font-size:12px;color:gray;">이 모바일 학생증은 공신력을 가지고 있지 않으며<br>특정 학교에서 사용이 불가할 수 있습니다.</p>

                <br>

                <a href="new_card.php" class="sm-btn-1">학생증 다시 등록하기</a>
                
                <div class="coin_appl" onclick='location.href="../"'>닫기</button>
            </center>

            <?php 
                } 

                if(!$already_have) {
            ?>

            <!-- 학생증을 등록하지 않았다면 -->
            <center>
                <h1>모바일 학생증</h1>
                <p class="mt-5">새로운 학생증을 등록해주세요.</p>
            </center>

            <div class="coin_appl" onclick="location.href='new_card.php'">새 학생증 등록</div>

            <?php } ?>
        </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </body>

    </html>