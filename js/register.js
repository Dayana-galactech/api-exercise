
function fetchcall() {
    var data = new FormData(document.getElementById("register"));
    fetch('/endpoints/signup.php', {
        method: 'POST',
        body: data,
    })
        .then(res => res.text())
        .then((txt) => {
           window.location = "/views/";
        });
        
    return false;
}
