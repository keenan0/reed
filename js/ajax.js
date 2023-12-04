function loadContent(fileName) {
    let http = new XMLHttpRequest();
    let content = document.getElementById("cont");

    http.onload = function () {
        if(this.status === 200 && this.readyState === 4){            
            content.innerHTML = this.responseText;
        }
    }

    http.open("GET", "../php/" + fileName);
    http.send();
}

function updateSearch(string) {
    let http = new XMLHttpRequest();
    let ansList = document.getElementById("ans");

    http.onload = function () {
        if(this.status === 200 && this.readyState === 4){            
            ansList.innerHTML = this.responseText;
        }
    }

    http.open("GET", "../inc/search.inc.php?songName=" + string);
    http.send();
}

function updateFilter(genre) {
    let http = new XMLHttpRequest();
    let ansList = document.getElementById("ans");

    http.onload = function () {
        if(this.status === 200 && this.readyState === 4){            
            ansList.innerHTML = this.responseText;
        }
    }

    http.open("GET", "../inc/filter.inc.php?filter=" + genre);
    http.send();
}

function checkFavorite(userId, songId){
    let http = new XMLHttpRequest();
    let ansList = document.getElementById("heart");

    http.onload = function () {
        if(this.status === 200 && this.readyState === 4){            
            ansList.innerHTML = this.response;
        }
    }

    http.open("GET", "../inc/favcheck.inc.php?user=" + userId + "&song=" + songId);
    http.send();
}

function updateFavorite(userId, songId){
    let http = new XMLHttpRequest();
    let ansList = document.getElementById("heart");

    http.onload = function () {
        if(this.status === 200 && this.readyState === 4){            
            ansList.innerHTML = this.response;
            
            if($("#FAVO").length){
                loadContent("library.php");
            }
        }
    }

    http.open("GET", "../inc/favorites.inc.php?user=" + userId + "&song=" + songId + "&same=true");
    http.send();
}


function removeFavorite(userId, songId) {
    let currentSong = $("#heart i").attr("onclick");

    updateFavoriteSPECIAL(userId, songId, currentSong);
}

function updateFavoriteSPECIAL(userId, songId, clickEvent){
    let http = new XMLHttpRequest();
    let ansList = document.getElementById("heart");

    http.onload = function () {
        if(this.status === 200 && this.readyState === 4){  
            console.log(ansList.childNodes[0]);
            
            if(ansList.childNodes[0].classList.contains("fa-solid")) {
                console.log("IS FAVORITE ALREADY");
                ansList.innerHTML = this.response;
            }
             
            if($("#FAVO").length){
                loadContent("library.php");
                $("#heart i").attr("onclick", clickEvent);
            }
        }
    }
        
    let query = "updateFavorite(" + userId + "," + songId + ")";

    if(query != clickEvent) {
        http.open("GET", "../inc/favsolid.inc.php?user=" + userId + "&song=" + songId + "&func=" + clickEvent);
    } else {
        http.open("GET", "../inc/favorites.inc.php?user=" + userId + "&song=" + songId);
    }

    http.send();
}

function removeRequest(reqId) {
    let http = new XMLHttpRequest();
    let notif = $(".notif")[0];

    http.onload = function () {
        if(this.status === 200 && this.readyState === 4){            
            console.log(reqId);
            loadContent("upload.php");
            
            notif.innerHTML = notif.innerHTML - 1;
        }
    }

    http.open("GET", "../inc/requestRemove.inc.php?reqId=" + reqId);
    http.send();
}