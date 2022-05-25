
function fetchcall() {
    var data = new FormData(document.getElementById("register"));
    fetch('http://localhost:8012/api-exercise/controllers/Users.php', {
        method: 'POST',
        body: data,
    })  
        .then(res => res.text())
        .then((txt) => {
           window.location = "http://localhost:8012/api-exercise/users/login";
        });
        
    return false;
}
