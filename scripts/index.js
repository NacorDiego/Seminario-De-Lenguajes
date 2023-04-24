//Para saber que cargó.
console.log("index.js");

// Creo el arreglo vacio para enviar al sv y recibirlo cargado con el json.
const data = [];

// Hago un fetch con la petición.
fetch('../scripts-PHP/renderizarCards.php', {
    method:'POST',
    headers: {
        'Content-Type': 'application/json'},
    body:JSON.stringify(data)
})
.then(response => response.json())
.then(responseData => {
    console.log(responseData)
})