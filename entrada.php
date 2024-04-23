<?php

    require 'includes/app.php'; // Incluye el archivo 'funciones.php' desde el directorio 'includes'
    
    incluirTemplate('header'); // Llama a la función incluirTemplate() con dos argumentos: 'header' como el nombre del archivo de plantilla a incluir.
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la decoración de tu hogar</h1>

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.webp" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="Imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>01/04/2024</span> por: <span>Admin</span> </p>

        <div class="resumen-propiedad">

            <p>Bienvenido a nuestra guía completa para la decoración de tu hogar. En este artículo, exploraremos consejos, ideas 
                y tendencias para ayudarte a transformar tus espacios en lugares acogedores y llenos de estilo.</p>

            <p>La decoración del hogar es mucho más que simplemente colocar muebles y accesorios en una habitación. Es una forma 
                de expresión personal que puede influir en tu estado de ánimo y bienestar. A lo largo de la historia, la decoración 
                del hogar ha evolucionado, reflejando las tendencias culturales y los estilos de vida de cada época.</p>

            <p>Antes de comenzar a decorar, es importante establecer objetivos claros y un presupuesto adecuado. Identificar tu 
                estilo personal te ayudará a tomar decisiones coherentes a lo largo del proceso. Además, el uso de herramientas 
                de diseño y planificación puede ayudarte a visualizar cómo se verán tus ideas en la realidad.</p>

            <p>Los colores tienen un gran impacto en la atmósfera de un espacio. Desde tonos cálidos y acogedores hasta colores 
                brillantes y enérgicos, la elección de colores puede influir en cómo percibimos un ambiente. Es importante considerar 
                la psicología del color y las tendencias actuales al seleccionar la paleta de colores para cada habitación.</p>

            <p>El mobiliario adecuado puede marcar la diferencia en la funcionalidad y estética de un espacio. Es importante elegir 
                muebles que se ajusten al tamaño y la forma de la habitación, así como a tu estilo de vida. Los accesorios decorativos, 
                como almohadas, lámparas y obras de arte, pueden agregar personalidad y estilo a cualquier habitación.</p>

            <p>La iluminación es un aspecto fundamental del diseño interior que a menudo se pasa por alto. Es importante considerar 
                los diferentes tipos de iluminación, como la luz ambiental, la luz de tarea y la luz decorativa, para crear el ambiente 
                deseado en cada habitación. Maximizar la luz natural siempre es una buena estrategia para hacer que un espacio se sienta 
                más abierto y acogedor.</p>

            <p>El arte y la decoración de paredes pueden agregar carácter y profundidad a un espacio. Ya sea mediante la incorporación 
               de obras de arte originales, fotografías familiares o elementos decorativos únicos, las paredes de tu hogar pueden convertirse 
               en una forma de expresión personal. Considera crear una galería de arte en casa para mostrar tus piezas favoritas de manera 
               creativa.</p>

            <p>Los textiles y texturas pueden agregar calidez y confort a cualquier habitación. Desde cortinas y alfombras hasta cojines 
               y mantas, la elección de telas suaves y acogedoras puede hacer que un espacio se sienta más acogedor y acogedor. 
               Experimenta con diferentes texturas para agregar interés visual y táctil a tu decoración.</p>

            <p>¡Esperamos que esta guía te haya inspirado a decorar tu hogar y crear espacios que reflejen tu personalidad y estilo de vida!</p>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>