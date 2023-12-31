// Utilidades para grabar PouchDB
const db = new PouchDB('solicitudes');


function guardarSolicitud( solicitud ) {

    solicitud._id = new Date().toISOString();

    return db.put( solicitud ).then( () => {

        console.log("Guardado en el pouchdb");

        self.registration.sync.register('nuevo-post');

        const newResp = { ok: true, offline: true };

        return new Response( JSON.stringify(newResp) );

    });

}


// Postear mensajes a la API
function postearMensajes() {

    const posteos = [];

    return db.allDocs({ include_docs: true }).then( docs => {


        docs.rows.forEach( row => {

            const doc = row.doc;

            const fetchPom = fetch('http://localhost/cuatri10/selenium_ide/save.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify( doc )
            }).then( res => {

                return db.remove( doc );

            });

            
            posteos.push( fetchPom );


        }); // fin del foreach

        return Promise.all( posteos );

    });





}

