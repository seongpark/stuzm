<?php
    include "../../db.php";

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
    echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }

    $sql3 = mq("select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){
        //그룹 생성 감지
        $group_check_info = $member["school"].$member["grade"]."g".$member["room"];
        
        $group_check = mq("select * from class_group where sch='$group_check_info'");
		$group_check = $group_check->fetch_array();
    }
?>
<!DOCTYPE html>
<html>

<head>

    <?php include "../../include/header_down_down.php"; ?>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<!--
<nav class="navbar fixed-top">
    <div class="top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../jiguem_gray.png" alt="Logo" width="100" class="d-inline-block align-text-top">
            </a>
        </div>
    </div>
</nav>
-->

<body>
    <form action="process/new_exam_process.php" method="post">
        <div id="center_card">
            <div id="i_header">
                <div class="back_btn">
                    <a href="../exam">
                        &#xE000;
                    </a>
                </div>
                <div id="i_info">
                    내신 성적 추가하기
                </div>
            </div>
            <div id="first_container">
                <label class="form-label">시험 년도</label>
                <input type="number" value="2023" onclick="this.select();" maxlength="2099" minlength="2020" class="form-control input_exam" required
                    name="year">
                <div class="user_info_div">
                    <label class="user_info_label">시험 종류</label>
                    <div class="div">
                        <input class="input_hide exam_appear" type="checkbox">
                        <div onclick="e()" class="exam_label">
                            <span class="exam_normal">시험 종류를 선택해주세요</span>
                            <i class="fa-solid fa-chevron-down down_icon"></i>
                        </div>
                        <div class="exam_select">
                            <div onclick="exam(0)">
                                <input class="input_hide exam" type="radio" id="1학기 중간고사" value="1학기 중간고사" name="exam"
                                    required />
                                <label class="exam_type">1학기 중간고사</label>
                            </div>
                            <div onclick="exam(1)">
                                <input class="input_hide exam" type="radio" id="1학기 기말고사" value="1학기 기말고사"
                                    name="exam" />
                                <label class="exam_type">1학기 기말고사</label>
                            </div>
                            <div onclick="exam(2)">
                                <input class="input_hide exam" type="radio" id="2학기 중간고사" value="2학기 중간고사"
                                    name="exam" />
                                <label class="exam_type">2학기 중간고사</label>
                            </div>
                            <div onclick="exam(3)">
                                <input class="input_hide exam" type="radio" id="2학기 기말고사" value="2학기 기말고사"
                                    name="exam" />
                                <label class="exam_type">2학기 기말고사</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">시험 과목</label>
                    <div class="div">
                        <input class="input_hide subj_appear" type="checkbox">
                        <div onclick="s()" class="subj_label">
                            <span class="subj_normal">시험의 과목을 선택해주세요</span>
                            <i class="fa-solid fa-chevron-down down_icon"></i>
                        </div>
                        <div class="subj_select">
                            <div onclick="subj(0)">
                                <input class="input_hide subj" type="radio" id="국어" value="국어" name="subj" required />
                                <label class="subj_type">국어</label>
                            </div>
                            <div onclick="subj(1)">
                                <input class="input_hide subj" type="radio" id="영어" value="영어" name="subj" />
                                <label class="subj_type">영어</label>
                            </div>
                            <div onclick="subj(2)">
                                <input class="input_hide subj" type="radio" id="수학" value="수학" name="subj" />
                                <label class="subj_type">수학</label>
                            </div>
                            <div onclick="subj(3)">
                                <input class="input_hide subj" type="radio" id="과학" value="과학" name="subj" />
                                <label class="subj_type">과학</label>
                            </div>
                            <div onclick="subj(4)">
                                <input class="input_hide subj" type="radio" id="역사" value="역사" name="subj" />
                                <label class="subj_type">역사</label>
                            </div>
                            <div onclick="subj(5)">
                                <input class="input_hide subj" type="radio" id="사회" value="사회" name="subj" />
                                <label class="subj_type">사회</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">세부 과목</label>
                    <input class="input_exam" type="number" autocomplete="off" name="detail_subject"
                        onclick="this.select();" value="<?php echo htmlentities("$member[number]");?>" required>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">점수</label>
                    <input class="input_exam" maxlength="3" type="number" autocomplete="off" name="number"
                        onclick="this.select();" value="<?php echo htmlentities("$member[number]");?>" required>
                </div>
            </div>
        </div>
        <div style="height: 100px;"></div>
        <button type="submit" class="coin_appl">내 성적 등록하기</button>
    </form>
    <script src="../../select_process.js"></script>
</body>

</html>