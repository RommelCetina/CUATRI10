window.onload = (e) => {
    if('serviceWorker' in navigator){
        navigator.serviceWorker.register('sw.js')
        .then((reg) => console.log("Service Worker registrado",reg))
        .catch((err) => console.log("Error al registrar sw",err));
    }else{
        console.log("No soportar el navegador el sw");
    }
}

var btn = document.getElementById('btnS');
var nombre = ddocument.getElementById('nombre');
var ape_paterno = ddocument.getElementById('ape_paterno');
var ape_materno = ddocument.getElementById('ape_materno');
var edad = ddocument.getElementById('edad');
var estatus = ddocument.getElementById('estatus');

btn.addEventListener('click', function(){
    var data = {
        nombre: nombre,
        ape_paterno: ape_paterno,
        ape_materno:ape_materno,
        edad: edad,
        estatus: estatus
    };
    fetch('http://localhost/cuatri10/selenium_ide/api/save.php',{
        method: 'post', 
        headers:{
            'content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(res=>res.json())
    .catch(err=> console.log('app.js error', err))
});

// Detectar cambios de conexión
function isOnline() {

    if ( navigator.onLine ) {
        // tenemos conexión
        alert('Estás Online');
    } else{
        // No tenemos conexión
        alert('Estás Offline');
    }

}

window.addEventListener('online', isOnline );
window.addEventListener('offline', isOnline );

isOnline();

