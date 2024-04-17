var eye = 0;
function pw_eye() {
    eye++;
    if (eye==1) {
        document.getElementById("pw_input").setAttribute("type", "text");
        document.getElementById("pw_eye").style.color="black";
    }
    if (eye==2) {
        document.getElementById("pw_input").setAttribute("type", "password");
        document.getElementById("pw_eye").style.color="#CECECE";
        eye=0;
    }
}
setInterval(() => {
    if(document.getElementById("pw_input").value!==""){
        document.getElementById("pw_eye").style.display="block";
    };
    if(document.getElementById("pw_input").value==""){
        document.getElementById("pw_eye").style.display="none";
        document.getElementById("pw_input").setAttribute("type", "password");
        document.getElementById("pw_eye").style.color="#CECECE";
        eye=0;
    };
}, 0);