document.addEventListener('DOMContentLoaded', function(){ // El documento esté cargado y haya cargado el HTML y CSS

    eventListeners(); // Llama a la función eventListeners()

    darkMode(); // Llama a la función darkMode()
}); // Tan pronto como esté cargado el documento va a ejecutar la función.

function darkMode(){ // Definicion de la función darkMode()

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)'); // Verifica si el usuario prefiere el modo oscuro en su configuración

    // Si el usuario prefiere el modo oscuro
    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode'); // Añade la clase 'dark-mode' al cuerpo del documento
    }else{ // Sino
        document.body.classList.remove('dark-mode'); // Elimina la clase 'dark-mode' del cuerpo del documento
    }

    prefiereDarkMode.addEventListener('change', function(){ // Detecta cambios de preferencia de color del sistema
        if(prefiereDarkMode.matches){ // Si tiene activado el modo oscuro
            document.body.classList.add('dark-mode'); // Agrega la clase 'dark-mode' al cuerpo del documento
        }else{ // Sino
            document.body.classList.remove('dark-mode'); // Elimina la clase 'dark-mode' del cuerpo del documento
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton'); // Selecciona el elemento con la clase 'dark-mode-boton' y la guarda en una varible

    botonDarkMode.addEventListener('click', function(){
        
        // .toggle = Va a agregar la clase si no la tiene, si ya la tiene la va a quitar
        document.body.classList.toggle('dark-mode'); // Lo va a agregar la clase en el body o la va a quitar del body
    });
}

function eventListeners(){ // Definicion de la funcion eventListeners
    const mobileMenu = document.querySelector('.mobile-menu'); // Selecciona el elemento con la clase 'mobile-menu' y la guarda en una variable

    mobileMenu.addEventListener('click', navegacionResponsive); // Cuando el click pase, se va a ejecutar la función
}

function navegacionResponsive(){ // Definicion de la funcion navegacionResponsive()
    const navegacion = document.querySelector('.navegacion'); // Selecciona el elemento con la clase 'navegacion'

    if(navegacion.classList.contains('mostrar')){ // Si el elemento 'nagevacion' tiene la clase 'mostrar'.
        navegacion.classList.remove('mostrar'); // Elimina la clase 'mostrar' del elemento 'navegacion'.
    }else{ // Sino
        navegacion.classList.add('mostrar'); // Añade la clase 'mostrar' al elemento 'navegacion'.
    }
}