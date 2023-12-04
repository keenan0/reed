// Am sters asta pentru ca atunci cand cautam o piesa si puneam spatiu pornea piesa
// document.addEventListener("keyup", evt => {
//     if(evt.code === "Space"){
//         console.log("space pressed");
//         hitBtn();
//     }
// });

window.addEventListener('keydown', function(e) {
    if(e.code === "Space" && e.target == document.body) {
      e.preventDefault();
    }
});