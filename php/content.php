<?php 
    require_once("../inc/dbh.inc.php");
    require_once("../inc/functions.inc.php");
?>

<section class="PLAYLIST">
    <h1>Playlist-uri recomandate</h1>
</section>
<section class="songSlideShow">
    <?php showPlaylist($conn, 2); ?>
</section>
<section class="songSlideShow">
    <?php showPlaylist($conn, 1); ?>
</section>

<section class="PLAYLIST">
    <h1>Albume si piese</h1>
</section>
<section class="songSlideShow">
    <?php showSongsFromAlbumGrid($conn, 1)?>
</section>
<section class="songSlideShow">
    <?php showSongsFromAlbumGrid($conn, 2)?>
</section>
<section class="songSlideShow">
    <?php showSongsFromAlbumGrid($conn, 3)?>
</section>
<section class="songSlideShow">
    <?php showSongsFromAlbumGrid($conn, 4)?>
</section>
<section class="songSlideShow">
    <?php showSongsFromAlbumGrid($conn, 5)?>
</section>
<section class="songSlideShow">
    <?php showSongsFromAlbumGrid($conn, 6)?>
</section>
<script src="../js/songs.js"></script>