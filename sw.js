//pouchDB
importScripts('https://cdn.jsdelivr.net/npm/pouchdb@7.0.0/dist/pouchdb.min.js');
importScripts('js/pouchdb.min.js');
importScripts('js/sw-db.js');
importScripts('js/sw-utils.js');

const CACHE_STATIC_NAME  = 'alumnos1';
const CACHE_DYNAMIC_NAME = 'alumnos2';
const CACHE_INMUTABLE_NAME = 'alumnos3';

const INMUTABLE = [

                'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js',
                'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css'
];

const APP_SHELL = [
    '/cuatri10/selenium_ide/',
    '/cuatri10/selenium_ide/alumnos.php',
    '/cuatri10/selenium_ide/detalle.php'
    
];

self.addEventListener("install", e => {
    console.log("Sevice worker instaldo");
    const cacheAPP_SHELL = caches.open( CACHE_STATIC_NAME )
        .then( cache => {
            return cache.addAll( APP_SHELL );       
        })
        .catch((err) => console.log("Error al registrar cache appShell",err));

    
    
        e.waitUntil( Promise.all([cacheAPP_SHELL]) );
});

self.addEventListener("active", e => {
    console.log("Sevice worker activado");
    //caches.delete(CACHE_NAME).then (console.log);
});


self.addEventListener("fetch", e => {
        console.log("Evento fetch");
        let respuesta;
        if ( e.request.url.includes('/api') ) {
            // return respuesta????
            console.log('Eventeo Fech manejar mensajes');
            console.log(e.request);
            respuesta = manejoApiMensajes( CACHE_DYNAMIC_NAME, e.request );
        } else {
            respuesta = caches.match( e.request ).then( res => {
            if ( res ) {
                actualizaCacheStatico( CACHE_STATIC_NAME, e.request, APP_SHELL );
                return res;
            } else {
                return fetch( e.request ).then( newRes => {
                    return actualizaCacheDinamico( CACHE_DYNAMIC_NAME, e.request, newRes );
                });
            }
        });
    }
    e.respondWith( respuesta );
});



//Asíncronas
self.addEventListener('sync', e => {

    console.log('SW: Sync', e.tag);

    if ( e.tag === 'nuevo-post' ) {

        // postear a BD cuando hay conexión
        const respuesta = postearMensajes();
        
        e.waitUntil( respuesta );
    }

});