

var  play = document.getElementById("play");
var  pic = document.getElementById("main");
var  cap = document.getElementById("capture");

cap.addEventListener("click", function(){
    var ctx = pic.getContext("2d");
    ctx.drawImage(play,0,0, 400, 400);
    save();
})


function feed() {
    // var player = document.getElementById("player");
    var constrains = {
        video: { width: 300, height: 300 }
    };
    navigator.mediaDevices.getUserMedia(constrains).then(stream => {
        play.srcObject = stream;
    });
}

function save(){
    var imgData = pic.toDataURL();
    // console.log(imgData);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "success"){
                alert("image saved!")
            } else {
                alert("failed to save the image");
            }
            
        }
    };
    xhttp.open("POST", "test.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image="+imgData);
    
}
feed();