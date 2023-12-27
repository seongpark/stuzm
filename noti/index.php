<?php
    include "../db.php";

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
    $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
        }
    
        $sql_update = mysqli_query($db, "update member set alert_read='0' where id='".$userid."'"); 
?>

<!DOCTYPE html>

<?php include "../include/header_down.php"; ?>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T9BERKPGHP"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'G-T9BERKPGHP');
</script>
<!--
<nav class="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="jiguem_gray.png" alt="Logo" height="24" class="d-inline-block align-text-top">
        </a>
    </div>
</nav>
-->

<body>

    <div id="noti_first_container">


        <div id="center_card">
            <?php
                $sql2 = mysqli_query($db, "select * from alert where userid='{$userid}' order by idx desc"); 
                $havelart = false;
                while($alert = $sql2->fetch_array())
                {
                    $havelart = true;
            ?>
            <div class="noti_div" onclick="location.href='<?php echo $alert['link'];?>';">
                <div>
                    <div class="d_flex space_between">
                        <div class="va_m_m noti_title">
                            <?php echo $alert["title"];?>
                        </div>
                        <a type="button" class="va_m_m" href="delete.php?idx=<?php echo $alert["idx"];?>">
                            <div class="close_icon"></div>
                        </a>
                    </div>
                    <div class="noti_discription"><?php echo $alert["content"];?></div>
                    <div class="noti_date"><?php echo $alert["date"];?></div>
                </div>
            </div>
            <?php 
                }
                if ($havelart == false) {
                    echo "<center>받은 알람이 없어요.</center><br>";
                }
            ?>
            <div class="proper_margin">
                <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR" data-ad-width="320"
                    data-ad-height="100">
                </ins>
                <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
            </div>

            <div class="fixed-topp top">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="../jiguem_gray.png" height="20" style="margin-bottom: 4px;">
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed-topp top">
            <div class="d_flex">
                <div id="logo">
                    <a href="../" style="vertical-align: middle;">&#xE000;</a>
                    <span>&nbsp;알림</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>