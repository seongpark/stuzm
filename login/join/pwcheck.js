setInterval(() => {
    pwcheck()
}, 0);
function pwcheck() {
    if ($("#password_check").val() !== "") {
        if ($("#password").val() == $("#password_check").val()) {
            document.getElementById('pw_check').innerHTML = '비밀번호가 일치합니다!';
            return true
        }
        else {
            document.getElementById('pw_check').innerHTML = '비밀번호가 일치하지 않습니다!';
            return false
        }
    }
}