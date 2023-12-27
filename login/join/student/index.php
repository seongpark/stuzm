<?php 
  include "../../db.php";
	 ?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUZM - 정보 입력(학생)</title>
    <link rel="stylesheet" href="../../../assets/style/style.css">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../../../assets/image/favicon.png" type="image/x-icon">
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


<body>
    <div id="user_info_header">
        <div class="back_btn">
            <a onclick="history.back();">
                &#xE000;
            </a>
        </div>
        <div id="user_info_info">
            정보 입력 (학생)
        </div>
    </div>
    <div id="user_info_first_container">
        <div id="center_card">
            <form method="post" action="../../member/join_process.php">
                <div class="user_info_div">
                    <label class="user_info_label">아이디*</label>
                    <input class="user_info_input" type="text" name="userid" onclick="this.select();" required autocomplete="off">
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">비밀번호*</label>
                    <input class="user_info_input" id="password" type="password" name="userpw" onclick="this.select();" required autocomplete="new-password">
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">비밀번호 확인*</label>
                    <input class="user_info_input" id="password_check" type="password" onclick="this.select();pwcheck()" required autocomplete="new-password">
                </div>
                <div id="pw_check"></div>
                <div class="user_info_div">
                    <label class="user_info_label">이름*</label>
                    <input class="user_info_input" type="text" autocomplete="off" name="name" onclick="this.select();"
                        required>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">전화번호*</label>
                    <input class="user_info_input" type="number" autocomplete="off" name="number"
                        onclick="this.select();" required>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">이메일*</label>
                    <input class="user_info_input" type="email" autocomplete="off" name="email" onclick="this.select();"
                        required>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">성별*</label>
                    <div class="div">
                        <input class="input_hide type_appear" type="checkbox">
                        <div onclick="g()" class="type_label">
                            <span class="type_normal">성별 선택</span>
                            <i class="fa-solid fa-chevron-down down_icon"></i>
                        </div>
                        <div class="type_select">
                            <div onclick="gender(0)">
                                <input class="input_hide gender" id="남자" value="남자" type="radio" name="gender"
                                    required />
                                <label class="types">남자</label>
                            </div>
                            <div onclick="gender(1)">
                                <input class="input_hide gender" id="여자" value="여자" type="radio" name="gender" />
                                <label class="types">여자</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_info_div birth_div">
                    <label class="user_info_label">생년월일*</label>
                    <div class="d_flex">
                        <div class="d_flex">
                            <input class="birth_input" id="year" type="number" name="year" maxlength="4" required
                                onclick="this.select();" autocomplete="off">
                            <span class="va_m_m birth">년</span>
                        </div>
                        <div class="d_flex">
                            <input class="birth_input" id="month" type="number" name="month" autocomplete="off"
                                maxlength="2" required onclick="this.select();">
                            <span class="va_m_m birth">월</span>
                        </div>
                        <div class="d_flex">
                            <input class="birth_input" id="day" type="number" name="day" autocomplete="off"
                                maxlength="2" required onclick="this.select();">
                            <span class="va_m_m birth">일</span>
                        </div>
                    </div>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">학교*</label>
                    <div class="div">
                        <input class="input_hide type_appear" type="checkbox">
                        <div onclick="s()" class="type_label">
                            <span class="type_normal">학교 선택</span>
                            <i class="fa-solid fa-chevron-down down_icon"></i>
                        </div>
                        <div class="type_select">
                            <div onclick="school(0)">
                                <input class="input_hide school" type="radio" id="강릉고등학교" value="강릉고등학교" name="school"
                                    required />
                                <label class="types">강릉고등학교</label>
                            </div>
                            <div onclick="school(1)">
                                <input class="input_hide school" type="radio" id="강릉명륜고등학교" value="강릉명륜고등학교"
                                    name="school" />
                                <label class="types">강릉명륜고등학교</label>
                            </div>
                            <div onclick="school(2)">
                                <input class="input_hide school" type="radio" id="강릉제일고등학교" value="강릉제일고등학교"
                                    name="school" />
                                <label class="types">강릉제일고등학교</label>
                            </div>
                            <div onclick="school(3)">
                                <input class="input_hide school" type="radio" id="강릉여자고등학교" value="강릉여자고등학교"
                                    name="school" />
                                <label class="types">강릉여자고등학교</label>
                            </div>
                            <div onclick="school(4)">
                                <input class="input_hide school" type="radio" id="강일여자고등학교" value="강일여자고등학교"
                                    name="school" />
                                <label class="types">강일여자고등학교</label>
                            </div>
                            <div onclick="school(5)">
                                <input class="input_hide school" type="radio" id="강릉문성고등학교" value="강릉문성고등학교"
                                    name="school" />
                                <label class="types">강릉문성고등학교</label>
                            </div>
                            <div onclick="school(6)">
                                <input class="input_hide school" type="radio" id="경포고등학교" value="경포고등학교"
                                    name="school" />
                                <label class="types">경포고등학교</label>
                            </div>
                            <div onclick="school(7)">
                                <input class="input_hide school" type="radio" id="주문진고등학교" value="주문진고등학교"
                                    name="school" />
                                <label class="types">주문진고등학교</label>
                            </div>
                            <div onclick="school(8)">
                                <input class="input_hide school" type="radio" id="강릉중앙고등학교" value="강릉중앙고등학교"
                                    name="school" />
                                <label class="types">강릉중앙고등학교</label>
                            </div>
                            <div onclick="school(9)">
                                <input class="input_hide school" type="radio" id="강릉정보공업고등학교" value="강릉정보공업고등학교"
                                    name="school" />
                                <label class="types">강릉정보공업고등학교</label>
                            </div>
                            <div onclick="school(10)">
                                <input class="input_hide school" type="radio" id="강원예술고등학교" value="강원예술고등학교"
                                    name="school" />
                                <label class="types">강원예술고등학교</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">학년*</label>
                    <div class="div">
                        <input class="input_hide type_appear" type="checkbox">
                        <div onclick="gr()" class="type_label">
                            <span class="type_normal">학년 선택</span>
                            <i class="fa-solid fa-chevron-down down_icon"></i>
                        </div>
                        <div class="type_select">
                            <div onclick="grade(0)">
                                <input class="input_hide grade" id="1학년" value="1" type="radio" name="grade" required />
                                <label class="types">1</label><span> 학년</span>
                            </div>
                            <div onclick="grade(1)">
                                <input class="input_hide grade" id="2학년" value="2" type="radio" name="grade" />
                                <label class="types">2</label><span> 학년</span>
                            </div>
                            <div onclick="grade(2)">
                                <input class="input_hide grade" id="3학년" value="3" type="radio" name="grade" />
                                <label class="types">3</label><span> 학년</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">반*</label>
                    <div class="div">
                        <input class="input_hide type_appear" type="checkbox">
                        <div onclick="c()" class="type_label">
                            <span class="type_normal">반 선택</span>
                            <i class="fa-solid fa-chevron-down down_icon"></i>
                        </div>
                        <div class="type_select">
                            <div onclick="classs(0)">
                                <input class="input_hide class" id="1반" value="1" type="radio" name="class" required />
                                <label class="types">1</label><span> 반</span>
                            </div>
                            <div onclick="classs(1)">
                                <input class="input_hide class" id="2반" value="2" type="radio" name="class" />
                                <label class="types">2</label><span> 반</span>
                            </div>
                            <div onclick="classs(2)">
                                <input class="input_hide class" id="3반" value="3" type="radio" name="class" />
                                <label class="types">3</label><span> 반</span>
                            </div>
                            <div onclick="classs(3)">
                                <input class="input_hide class" id="4반" value="4" type="radio" name="class" />
                                <label class="types">4</label><span> 반</span>
                            </div>
                            <div onclick="classs(4)">
                                <input class="input_hide class" id="5반" value="5" type="radio" name="class" />
                                <label class="types">5</label><span> 반</span>
                            </div>
                            <div onclick="classs(5)">
                                <input class="input_hide class" id="6반" value="6" type="radio" name="class" />
                                <label class="types">6</label><span> 반</span>
                            </div>
                            <div onclick="classs(6)">
                                <input class="input_hide class" id="7반" value="7" type="radio" name="class" />
                                <label class="types">7</label><span> 반</span>
                            </div>
                            <div onclick="classs(7)">
                                <input class="input_hide class" id="8반" value="8" type="radio" name="class" />
                                <label class="types">8</label><span> 반</span>
                            </div>
                            <div onclick="classs(8)">
                                <input class="input_hide class" id="9반" value="9" type="radio" name="class" />
                                <label class="types">9</label><span> 반</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user_info_div">
                    <label class="user_info_label">번호*</label>
                    <input class="user_info_input" type="number" name="bunho" maxlength="2" autocomplete="off" required
                        onclick="this.select();">
                </div>
                <div class="user_info_div" style="height:100px"></div>
                <div class="user_info_div" class="fixed-bottom">
                    <div class="user_info_div">
                        <div class="user_info_div">
                            <div id="fixed-bottom">
                                <button id="submit_btn" type="submit"onclick="return pwcheck()">완료</button>
                            </div>
                            <a href="member_pw_update.php" style="color: white!important;">비밀번호
                                변경
                            </a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <script src="../../select_process.js"></script>
    <script src="../pwcheck.js"></script>
</body>

</html>