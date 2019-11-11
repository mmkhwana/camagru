

var  play = document.getElementById("play");
var  stickers = document.getElementById("stickers");
const stickerName = document.querySelector("#sticker-name");
var  pic = document.getElementById("main");
var  chose = document.querySelector('#choose');
var  cap = document.getElementById("capture");
var previewImage = document.querySelector("#chosen-img");
cap.addEventListener("click", function(){
    if (stickerName.value != "none")
    {
        var ctx = pic.getContext("2d");
        ctx.drawImage(play,0,0, 400, 400);
        ctx.drawImage(previewImage,0,0, 400, 400);
        save();
    }
    else
        alert("Please insert sticker");
});
chose.addEventListener('change', (event)=>{
    var reader = new FileReader;
    reader.addEventListener('load', (event)=>{
       previewImage.src = reader.result;
    });
    reader.readAsDataURL(chose.files[0]);
});
stickers.addEventListener('change', (event)=>{
    stickerName.value = stickers.value;
});

function feed() {
    // var player = document.getElementById("player");
    var constrains = {
        video: { width: 300, height: 300 }
    };
    navigator.mediaDevices.getUserMedia(constrains).then(stream => {
        play.srcObject = stream;
    });
}

function removeImage(event)
{
    var imageData = event.srcElement.src;
    var filename = imageData.replace(/^.*[\\\/]/, '');
    if (event.button == 2)
    {
        var answer = window.confirm("Want to remove the image?")
        if (answer) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == "success"){
                        alert("Image Removed");
                    } 
                    else 
                    {
                        alert("failed to remove the image");
                    }
                    
                }
            };
            xhttp.open("POST", "remove_pics.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("image="+filename);
        }
    }

}
function save(){
    var imgData = pic.toDataURL('image/png');
    // console.log(imgData);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "success"){
                alert("Image Saved");
            } 
            else 
            {
                alert("failed to save the image");
            }
            
        }
    };
    xhttp.open("POST", "camupload.php", true);
    // xhttp.open("POST", "upload.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("image="+imgData+"&img="+stickerName.value);
}
feed();