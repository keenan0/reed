async function Show(albumId) {
    $(".songs2" + albumId).toggle(500);

    let icon = $("#toggle" + albumId); 
    if(icon.hasClass("fa-square-caret-down")){
        icon.removeClass("fa-square-caret-down");
        icon.addClass("fa-square-caret-up"); 
    } else {
        icon.removeClass("fa-square-caret-up"); 
        icon.addClass("fa-square-caret-down");
    }
}