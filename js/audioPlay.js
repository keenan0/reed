let isPlaying = false;

let audio = document.getElementById("playbar");

//Cand o melodie se termina automat incepe alta
audio.addEventListener("ended", ()=>{
    nextSong();
});

let songIndex = 0;
//let songs = ["Veste", "Sanguine Paradise", "Yale", "New Tank", "Too Many Nights", "High Hopes"];
let songs = ['1', '8'];
let songsNames = ["YOSEMITE", "SKELETONS"];
let songsAuthors = ["Travis Scott", "Travis Scott"];
let songsAlbumId = ["../albums/1.jpg", "../albums/1.jpg"]; 

let userId = $("#userId")[0].innerHTML;

async function AddSong(fileId, fileName, author, albumId) {
    if(songs.includes(fileId)) {
        for(let i = 0; i < songs.length; ++i){
            if(fileId === songs[i])
                ChangeSong(fileId, fileName, author, albumId);
        }

        return;
    }

    songs.push(fileId);
    songsNames.push(fileName);
    songsAuthors.push(author);
    songsAlbumId.push(albumId);

    songIndex = 1;
    ChangeSong(fileId, fileName, author, albumId);
}

async function LoadSong(fileName) {
    /*
        @retrun void
        Functia reseteaza sursa elementului audio [src] din pagina web si reincarca elementul pentru a putea canta piesa noua aleasa [fileName].
        Seteaza titlul cu numele piesei.
    */
    
    let audio = document.getElementById("playbar");
    
    audio.setAttribute("src", "../songs/" + fileName + ".mp3");
    audio.load(); 

    //console.log(getPos(fileName));
    songIndex = getPos(fileName);
    document.title = "eed | " + songsNames[getPos(fileName)]; 

    //ceva care sa updateze iconita cu favorite de la playNavbar
    let favIcon = $("#heart")[0];
    checkFavorite(userId, fileName);
}

function getPos(id) {
    for(let i = 0; i < songs.length; ++i){
        if(id === songs[i])
            return i;
    }

    return 0;
}

async function PauseSong() {
    /*
        @return void
        Functia opreste melodia curenta si schimba iconita din play in pauza.
    */
    
    let audio = document.getElementById("playbar");
    let playBtn = document.getElementById("audioPlayButton");
    
    audio.pause();
    isPlaying = false;
    playBtn.classList.remove("fa-pause");
    playBtn.classList.add("fa-play");
}

async function PlaySong() {
    /* 
        @return void
        Functia porneste melodia curenta si modifica iconita in cea de pauza.
    */
    console.log("CANTA");

    let audio = document.getElementById("playbar");
    let playBtn = document.getElementById("audioPlayButton");
    
    audio.play();
    isPlaying = true;
    playBtn.classList.remove("fa-play");
    playBtn.classList.add("fa-pause");
}

function ChangePlayNames(title, author, albumId){
    console.log(title, author, albumId);
    if(!title || !author || !albumId) return;   

    console.log(title, author);

    $("#playTitle")[0].innerHTML = title;
    $("#playAuthor")[0].innerHTML = author;
    $("#activeSongImage").attr("src", albumId);
}

async function ChangeSong(fileName, title, author, albumId){
    /*
        @return void
        Functia se foloseste de cele 3 functii ajutatoare pentru a schimba melodia curenta in [fileName].
    */
    PauseSong();
    LoadSong(fileName);
    PlaySong();    
    
    ChangePlayNames(title, author, albumId);
}

async function hitBtn() {
    /*
        @return void
        Functia este apelata doar de butonul din meniul de control. Aceasta opreste sau porneste melodia curenta.
    */

    if(isPlaying){
        PauseSong();
    } else { 
        PlaySong();
    }
}

async function prevSong() {
    /*
        @return void
        Functia merge inapoi cu o piesa.
    */

    if(songIndex == 0){
        songIndex = songs.length - 1;
    } else {
        songIndex = (songIndex - 1) % songs.length;
    }
    
    ChangePlayNames(songsNames[songIndex], songsAuthors[songIndex], songsAlbumId[songIndex]);

    ChangeSong(songs[songIndex]);
}

async function nextSong() {
    /*
        @return void
        Functia merge inainte cu o piesa.
    */
    
    songIndex = (songIndex + 1) % songs.length;

    ChangePlayNames(songsNames[songIndex], songsAuthors[songIndex], songsAlbumId[songIndex]);
    ChangeSong(songs[songIndex]);
}

LoadSong("1");