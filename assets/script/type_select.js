function select(x) {
    document.getElementById("type_normal").innerHTML = document.getElementsByClassName("types")[x].innerHTML
    document.getElementById("type_appear").checked = false
    document.getElementById("type_normal").style.color="black"
    document.getElementById("type_div").style.borderBottom="1px solid black";
    document.getElementById("down_icon").style.color="black";
    document.getElementsByClassName("checkbox")[x].checked="true";
}
var c = 0
function check() {
    c++ 
    if(c==1) {
        document.getElementById("type_appear").checked = true
    }
    if(c==2) {
        document.getElementById("type_appear").checked = false
        c=0
    }
}
setInterval(() => {
    if(document.getElementById("type_appear").checked) {
        document.getElementById("type_div").style.borderBottom="none";
    }
    if(!document.getElementById("type_appear").checked) {
        if(document.getElementById("type_normal").innerHTML == "계정 유형 선택") {
            document.getElementById("type_div").style.borderBottom="1px solid #C0C0C0";
        }
        if(document.getElementById("type_normal").innerHTML !== "계정 유형 선택") {
            document.getElementById("type_div").style.borderBottom="1px solid black";
        }
    }
}, 0);