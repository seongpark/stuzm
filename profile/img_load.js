function loadFile(input) {
    var file = input.files[0];	//선택된 파일 가져오기


  	//새로운 이미지 div 추가
    var newImage = document.createElement("img");
    newImage.setAttribute("class", 'img');

    //이미지 source 가져오기
    newImage.src = URL.createObjectURL(file);

    //이미지를 image-show div에 추가
    document.getElementById('image-show').innerHTML="";
    var container = document.getElementById('image-show');
    container.appendChild(newImage);
};