
function fetchcall() {
    var data = new FormData(document.getElementById("register"));
    fetch('http://localhost:8012/api-exercise/endpoints/signup.php', {
        method: 'POST',
        body: data,
    })
        .then(res => res.text())
        .then((txt) => {
            document.querySelector("#response").style.display = 'block',
                document.querySelector("#response").innerHTML = txt
        });
        
    return false;
}
