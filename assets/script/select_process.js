//시험선택
function exam(x) {
    document.getElementsByClassName("exam")[x].checked="true";
    document.getElementsByClassName("exam_normal")[0].innerHTML = document.getElementsByClassName("exam_type")[x].innerHTML
    document.getElementsByClassName("exam_appear")[0].checked = false
    document.getElementsByClassName("exam_normal")[0].style.color="black"
    document.getElementsByClassName("exam_label")[0].style.borderBottom="1px solid #C0C0C0";
    document.getElementsByClassName("down_icon")[0].style.color="black";
}
var ex = 0
function e() {
    ex++ 
    if(ex==1) {
        document.getElementsByClassName("exam_appear")[0].checked = true
    }
    if(ex==2) {
        document.getElementsByClassName("exam_appear")[0].checked = false
        ex=0
    }
}
setInterval(() => {
    if(document.getElementsByClassName("exam_appear")[0].checked) {
        document.getElementsByClassName("exam_label")[0].style.borderBottom="none";
    }
    if(!document.getElementsByClassName("exam_appear")[0].checked) {
        if(document.getElementsByClassName("exam_normal")[0].innerHTML == "시험 종류를 선택해주세요") {
            document.getElementsByClassName("exam_label")[0].style.borderBottom="1px solid #C0C0C0";
        }
        if(document.getElementsByClassName("exam_normal")[0].innerHTML !== "시험 종류를 선택해주세요") {
            document.getElementsByClassName("exam_label")[0].style.borderBottom="1px solid #C0C0C0";
        }
    }
}, 0);
//과목선택
function subj(x) {
    document.getElementsByClassName("subj")[x].checked="true";
    document.getElementsByClassName("subj_normal")[0].innerHTML = document.getElementsByClassName("subj_type")[x].innerHTML
    document.getElementsByClassName("subj_appear")[0].checked = false
    document.getElementsByClassName("subj_normal")[0].style.color="black"
    document.getElementsByClassName("subj_label")[0].style.borderBottom="1px solid #C0C0C0";
    document.getElementsByClassName("down_icon")[0].style.color="black";
}
var su = 0
function s() {
    su++ 
    if(su==1) {
        document.getElementsByClassName("subj_appear")[0].checked = true
    }
    if(su==2) {
        document.getElementsByClassName("subj_appear")[0].checked = false
        su=0
    }
}
setInterval(() => {
    if(document.getElementsByClassName("subj_appear")[0].checked) {
        document.getElementsByClassName("subj_label")[0].style.borderBottom="none";
    }
    if(!document.getElementsByClassName("subj_appear")[0].checked) {
        if(document.getElementsByClassName("subj_normal")[0].innerHTML == "학교 선택") {
            document.getElementsByClassName("subj_label")[0].style.borderBottom="1px solid #C0C0C0";
        }
        if(document.getElementsByClassName("subj_normal")[0].innerHTML !== "학교 선택") {
            document.getElementsByClassName("subj_label")[0].style.borderBottom="1px solid #C0C0C0";
        }
    }
}, 0);