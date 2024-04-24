<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo de la propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

    <label for="descripcion">Descripción de la propiedad:</label>
    <textarea id="descripcion" name="descripcion"> <?php echo s($propiedad->descripcion);?></textarea>

</fieldset>

<fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">¿Cuántas habitaciones tiene la propiedad?</label>
        <input 
            type="number" 
            id="habitaciones" 
            name="habitaciones" 
            placeholder="Ej: 3" 
            min="1" 
            max="9" 
            value="<?php echo s($propiedad->habitaciones); ?>"
        >

    <label for="wc">¿Cuántos baños tiene la propiedad?</label>
        <input 
            type="number" 
            id="wc" 
            name="wc" 
            placeholder="Ej: 4" 
            min="1" 
            max="9" 
            value="<?php echo s($propiedad->wc); ?>"
        >

    <label for="estacionamiento">¿Cuántas lugares de estacionamiento tiene la propiedad?</label>
        <input 
            type="number" 
            id="estacionamiento" 
            name="estacionamiento" 
            placeholder="Ej: 2" 
            min="1" 
            max="5" 
            value="<?php echo s($propiedad->estacionamiento); ?>"
        >

</fieldset>

<fieldset>
    <legend>Vendedor</legend>

</fieldset>