
function fetchcall() {
    var data = new FormData(document.getElementById("register"));
    fetch('http://localhost:8000/index.php?url=/users/register', {
        method: 'POST',
        body: data,
    })  
        .then(res => res.text())
        .then((txt) => {
           // window.location = "http://localhost:8000/index.php?url=/users/register";
        });
        
    return false;
}
