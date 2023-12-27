<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUZM - 회원가입</title>
    <link rel="stylesheet" href="../style.css?ver=2">
    <link rel="stylesheet" href="../../assets/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../../assets/image/favicon.png" type="image/x-icon">
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
    <div id="terms_first_container">
        <div id="center_card">
            <div id="terms_header">
                <div class="back_btn">
                    <a href="../">
                        &#xE000;
                    </a>
                </div>
                <div id="terms_info">
                    약관 동의
                </div>
                <div id="terms_discription">이용 약관에 동의해주세요.</div>
            </div>

            <div id="center_card">
                <div id="container">
                    <form action="../join/" method="post">
                        <div class="terms as">
                            <div class="terms_info"><a><span id="all_select" onclick="selectAll(this)">모두
                                            선택</span></a></div>
                            <div class="terms_checkbox"><input id="select_all" type="checkbox"  name="selectall" class="checkbox cb" onclick="selectAll(this)"/></div>
                        </div>
                        <div class="terms">
                            <div class="terms_info"><span class="requier">(필수)</span> <a
                                        href="../../about/privacy.html">개인정보처리방침 &#xE001;</a></div>
                            <div class="terms_checkbox"><input id="checkbox1" name="require" onclick='checkSelectAll()' type="checkbox" class="checkbox cb"
                                    required /></div>
                        </div>
                        <div class="terms">
                            <div class="terms_info"><span class="requier">(필수)</span> <a
                                        href="../../about/term.html">이용약관 &#xE001;</a></div>
                            <div class="terms_checkbox"><input id="checkbox2" name="require" onclick='checkSelectAll()' type="checkbox" class="checkbox cb"
                                    required /></div>
                        </div>
                        <div class="terms">
                            <div class="terms_info"><span class="requier">(필수)</span> <a
                                        href="../../about/sms.html">SMS 수신 동의 &#xE001;</a></div>
                            <div class="terms_checkbox"><input id="checkbox3" name="require" onclick='checkSelectAll()' type="checkbox" class="checkbox cb"
                                    required /></div>
                        </div>
                        <div class="terms">
                            <div class="terms_info"><span class="requier">(필수)</span> <a
                                        href="../../about/term_community.html">커뮤니티 규정 &#xE001;</a></div>
                            <div class="terms_checkbox"><input id="checkbox4" name="require" onclick='checkSelectAll()' type="checkbox" class="checkbox cb"
                                    required /></div>
                        </div>
                        <p style="color:gray;font-size:12px;">약관을 거부할 권리가 있으나, 약관을 거부하는 경우 이용이 불가합니다.</p>

                        <div id="fixed-bottom">
                            <button id="submit_btn" type="submit">다음</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/script/select_all.js"></script>
</body>

</html>