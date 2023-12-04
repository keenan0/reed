$(document).ready(function(){
    $("body").on('click', ".grid-card", function(){
        $songId = $(this).find("span")[0].innerHTML;
        $songName = $(this).find("h1")[0].innerHTML;
        $author = $(this).find("p")[0].innerHTML;
        $albumId = $(this).find("img").attr("src");

        AddSong($songId, $songName, $author, $albumId);
    }); 

    $("body").on('click', ".flex", function(){
        $songId = $(this).find("h1")[0].innerHTML;
        $songName = $(this).find("span")[0].innerHTML;
        $author = $(this).find("span")[1].innerHTML;
        $albumId = $(this).find("img").attr("src");
        
        AddSong($songId, $songName, $author, $albumId);
    }); 

    $("body").on('click', ".searchCard a", function(){
        $songId = $(this).find("span")[0].innerHTML;
        $songName = $(this).find("span")[1].innerHTML;
        
        $author = $songName.slice(0, $songName.indexOf('-') - 1);
        $albumId = $(this).find("img").attr("src");

        for(let i = 0; i < $songName.length; ++i){
            if($songName[i] === '-'){
                $songName = $songName.slice(i + 2, $songName.length);
                break;
            }
        }

        AddSong($songId, $songName, $author, $albumId);    
    });

    $("body").on('click', ".searchCard2 a", function(){
        $songId = $(this).find("span")[0].innerHTML;
        $songName = $(this).find("span")[2].innerHTML;
        
        $author = $(this).find("span")[1].innerHTML;
        $albumId = $(this).find("span")[4].innerHTML;

        AddSong($songId, $songName, $author, $albumId);    
    });
});

