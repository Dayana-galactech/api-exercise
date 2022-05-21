function login() {
    var data = new FormData(document.getElementById("login"));
    fetch('http://localhost:8012/api-exercise/endpoints/signin.php', {
        method: 'POST',
        body: data,
    })
        .then(res => res.text())
        .then((txt) => {
            document.querySelector("#responselogin").style.display = 'block',
            document.querySelector("#responselogin").innerHTML = txt
        });
        
    return false;
}