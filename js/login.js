function login() {
    var data = new FormData(document.getElementById("login"));
    fetch('http://localhost:8012/api-exercise/users/login', {
        method: 'POST',
        body: data,
    })
        .then(res => res.text())
        .then((txt) => {
           window.location = "../views/";
        });
        
    return false;
}