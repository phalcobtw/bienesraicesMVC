<fieldset>
            <legend>Información General</legend>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" placeholder="Nombre Vendedor" name="vendedor[nombre]" value="<?php echo s($vendedor->nombre); ?>">

            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" placeholder="Apellido Vendedor" name="vendedor[apellido]" value="<?php echo s($vendedor->apellido); ?>">            

    </fieldset>
    <fieldset>
        <legend>Información Extra</legend>

        <label for="telefono">Telefono</label>
        <input type="text" id="telefono" placeholder="Telefono" name="vendedor[telefono]" value="<?php echo s($vendedor->telefono); ?>">
        
    </fieldset>