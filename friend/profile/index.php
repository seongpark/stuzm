<?php
include "../../db.php";
$_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

$bno = htmlentities($_GET["idx"]);

$postcheecksql = mysqli_query($db, "select * from member where idx='{$bno}'");
$num_rows = mysqli_num_rows($postcheecksql);
if ($num_rows >= 1) {
} else {
    echo "<script>alert('존재하지 않는 페이지입니다.');history.back();</script>";
    exit;
}

$sql_load_member = mysqli_query($db, "select * from member where idx='{$bno}'");
while ($member = $sql_load_member->fetch_array()) {
    $send_id = $member["id"];
    $profile_idx = $member["idx"];
    $profile_name = $member["name"];
    $profile_school = $member["school"];
    $profile_grade = $member["grade"];
    $profile_room = $member["room"];
    $profile_access = $member["access"];
    $profile_img = $member["profile_image"];
}
?>
<html lang="ko">
<meta charset="UTF-8">

<title>STUZM</title>

<!-- 검색 엔진 인증용 !-->
<meta name="google-site-verification" content="9YIIJMMxuETigC_iffGolBj0zn1_4LCj6K2hF-3V4y4" />
<meta name="naver-site-verification" content="6810830ae977a0d75569675929271f68083f95e5" />

<!-- meta 태그 !-->
<meta name="description" content="STUZM 스터즘 고등학생을 위한 SNS">
<meta property="og:type" content="website">
<meta property="og:title" content="STUZM">
<meta property="og:description" content="고등학생을 위한 SNS">
<meta property="og:image" content="https://stuzm.com/assets/imgddddd.png">
<meta property="og:url" content="https://stuzm.com/">
<meta property="og:site_name" content="STUZM">
<meta property="og:locale" content="ko_KR">
<meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=0">
    <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=0">

<!-- 스타일 CSS !-->
<link rel="stylesheet" href="../../assets/style/style.css?ver=7">

<!-- 파비콘 !-->
<link rel="shortcut icon" href="../../assets/image/favicon.png" type="image/x-icon">

<!-- 프레임워크 !-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

<!-- 웹폰트 !-->
<link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>

<!-- 필수 스크립트 로드 -->
<script src="../../assets/script/dropdown.js"></script>
<script src="../../assets/script/modal.js"></script>

    <link rel="stylesheet" href="style.css">
    
    <style>
    .btn-outline-primary {
        border-radius: 50px;
    }

    .btn-outline-danger {
        border-radius: 50px;
    }

    .back_btn>a {
        color: #fff;
    }
    </style>

    <!-- 구글 애널리틱스 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T9BERKPGHP"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'G-T9BERKPGHP');
</script>

<!-- 로딩 페이지  -->
<div id="load">
    <img src="../../assets/image/Half circle.gif" alt="loading">
</div>

<script>
const loading_page = document.getElementById("load");
window.onload = function() {
    loading_page.style.display = 'none';
}
</script>

</head>

<body>
    <div id="profile_first_container">
        <div id="center_card">
            <div id="profile_header">
                <div class="back_btn" style="padding-top:18px;">
                    <a onclick='location.href="../";'>
                        &#xE000;
                    </a>
                </div>
                <div id="profile_info">
                    <div id="profile_img"><img src="../../profile/img/<?php echo htmlentities("$profile_img"); ?>" />
                    </div>
                    <div id="profile_class" style="margin-top:5px;">
                        <div id="friend_name">
                            <?php echo htmlentities("$profile_name"); ?> &nbsp;

                            
                        </div>
                        <div id="intro">
                            <?php
                            if($profile_grade == "") {
                                echo htmlentities("$profile_school");
                            }else{
                            echo htmlentities("$profile_school") . " " . htmlentities("$profile_grade") . "학년 " . htmlentities("$profile_room") . "반";
                            if ($profile_access == "teacher") {
                                echo " (선생님)";
                            }
                        }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="container">
                <div id="ask">
                    <div id="askk">
                        <div id="a_name"><input autocomplete="off" class="frm2" id="asker_name" name="name"
                                placeholder="이름 (미입력시 익명)" />
                        </div>
                        <textarea id="asker_content" class="frm2" name="content" placeholder="새 질문을 등록해 보세요!"
                            required></textarea>
                        <div id="a_submit"><button id="asker_submit" onclick="ask_function()">등록하기</button></div>
                    </div>
                </div>


                <?php 
                if($send_id == $my_id) {
                ?>

                <!-- 여기부터 계정 주인 인터페이스 -->
                <div id="header_selection" style="margin: 23px 0px 22px;" class="d_flex">
                    <a class="<?php if(@$_GET["type"] == "waiting") { echo "header_none_active"; } else { echo "header_active"; } ?>" href="index.php?idx=<?= $bno; ?>">
                        <div>답변된 질문</div>
                    </a>
                    <a class="<?php if(@$_GET["type"] == "waiting") { echo "header_active"; } else { echo "header_none_active"; } ?>" href="index.php?idx=<?= $bno; ?>&type=waiting">
                        <div>대기중 질문</div>
                    </a>
                </div>

            <?php } ?>
                <!-- 여기부터 사용자 인터페이스 -->
                <div id="ask_count">
                    <div>
                        <div class="count_text">답변된 질문</div>
                        <div class="count">
                            <?php 
                                $sql = "SELECT COUNT(*) AS count FROM ask where send_id='$my_id' and answer='1'";
                                $result = $db->query($sql);     
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $recordCount = $row["count"];
                                    echo $recordCount;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </div>
                    </div>
                    <div id="vertical_line"></div>
                    <div>
                        <div class="count_text">대기중 질문</div>
                        <div class="count">
                            <?php 
                                $sql = "SELECT COUNT(*) AS count FROM ask where send_id='$my_id' and answer='0'";
                                $result = $db->query($sql);     
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $recordCount = $row["count"];
                                    echo $recordCount;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </div>
                    </div>
                </div>


                <div id="ask_container"></div>
            </div>
        </div>
    </div>
    <div style="height: 100px;"></div>
    <script src="../../downdrop.js"></script>
    <script src="../../modal.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script>
    function ask_function() {
        if ($("#asker_content").val() !== "") {
            $.ajax({
                type: "post",
                url: "new_ask.php?member=<?= $bno; ?>",
                data: {
                    name: $("#asker_name").val(),
                    content: $("#asker_content").val()
                },
                success: function() {
                    $("#asker_name").val('');
                    $("#asker_content").val('');
                    alert('질문이 등록 되었습니다!');
                    refreshAskContainer();
                },
                error: function() {
                    alert('질문 등록에 실패했습니다!');
                }
            });
        } else {
            alert('질문을 입력해 주세요!');
        }
    }

    function reply_ask(x) {
        if ($("#modal_reply_input" + x).val() !== "") {
            $.ajax({
                type: "post",
                url: "reply_ask.php?idx=" + x,
                data: {
                    content: $("#modal_reply_input" + x).val()
                },
                success: function(data) {
                    $("#modal_reply_input" + x).val('');
                    alert('답변이 등록 되었습니다!');
                    console.log(data); // 서버에서 받은 응답을 콘솔에 출력
                    refreshAskContainer();
                    document.body.style.overflow = "visible";
                    document.body.style.touchAction = "auto";
                },
                error: function(xhr, status, error) {
                    alert('답변을 등록하는 도중 오류가 발생했습니다.');
                    console.log(xhr.responseText); // 오류 응답을 콘솔에 출력
                    console.log(status);
                    console.log(error);
                }
            });
        } else {
            alert('답변을 입력해 주세요!');
        }
    }


    function delete_ask(p) {
        if (confirm("정말 삭제하시겠습니까?")) {
            $.ajax({
                type: "post",
                url: p,
                success: function() {
                    refreshAskContainer();
                },
                error: function() {
                    alert('삭제에 실패했습니다.');
                }
            });
        }
    }

    function delete_reply(x, y, z) {
        if (confirm("정말 삭제하시겠습니까?")) {
            $.ajax({
                type: "get",
                url: "answer_delete.php",
                data: {
                    idx: x,
                    profile: y,
                    original: z
                },
                success: function() {
                    refreshAskContainer();
                },
                error: function() {
                    alert('답변 삭제에 실패했습니다!');
                }
            });
        }
    }

    <?php
        if(@$_GET["type"] == "waiting") {
    ?>
    function refreshAskContainer() {
        $.ajax({
            url: "ask_ajax_process.php?idx=<?= $bno ?>&type=waiting"
        }).done(function(data) {
            $("#ask_container").html(data);
        });
    }
    <?php }else { ?>
        function refreshAskContainer() {
        $.ajax({
            url: "ask_ajax_process.php?idx=<?= $bno ?>"
        }).done(function(data) {
            $("#ask_container").html(data);
        });
    }
    <?php } ?>

    setTimeout(() => {
        refreshAskContainer();
    }, 0);
    </script>
</body>

</html>