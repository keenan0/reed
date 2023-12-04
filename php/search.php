<form autocomplete="off">
    <input placeholder="Caută o piesă..." id="searchBar" type="text" onkeyup="updateSearch(this.value)">
    <div class="filters">    
        <span>Filtre: </span>
        <button class="filterBtn" onclick="updateFilter('rap')">Rap</button>
        <button class="filterBtn" onclick="updateFilter('rock')">Rock</button>
        <button class="filterBtn" onclick="updateFilter('pop')">Pop</button>
        <button class="filterBtn" onclick="updateFilter('traditional')">Traditional</button>
    </div>
</form>

<div class="answers">
    <h1 class="btn">Melodii găsite:</h1>
    <p id="ans">

    </p>
</div>

<script src="../js/songs.js"></script>