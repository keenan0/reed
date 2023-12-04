let artistsClasses = document.getElementsByClassName("artists");
let artists = artistsClasses[0];
let increment = 1;

let artist = artists[0];

function moveImage() {
    
}

const testing = setInterval(moveImage, 100);

function togglePassword() {
    let toggle = document.getElementById("tglPwd");

    if(toggle.type === "password"){
        toggle.type = "text";
    } else {
        toggle.type = "password";
    }
}