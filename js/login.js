function login() {
    var data = new FormData(document.getElementById("login"));
    fetch('../endpoints/signin.php', {
        method: 'POST',
        body: data,
    })
        .then(res => res.text())
        .then((txt) => {
           window.location = "../views/";
        });
        
    return false;
}