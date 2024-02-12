<main class="contenedor">
        <h1>Administrador de Bienes Raices</h1>
        <?php 
        if ($resultado) {
            $mensaje = mostrarNotificacion(intval($resultado));
            if ($mensaje) { ?>
                <p class="alerta exito"><?php echo s($mensaje)?></p>
             <?php } 
        }
        ?>
            
        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>
        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!-- Mostrar Resultados -->
            <?php foreach($propiedades as $propiedadobj): ?>
                <tr>
                    <td><?php echo $propiedadobj->id; ?></td>
                    <td><?php echo $propiedadobj->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedadobj->imagen; ?>" alt="imagen" class="imagen-tabla"></td>
                    <td>$<?php echo $propiedadobj->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedadobj->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input href="#" class="boton-rojo-block" type="submit" value="Eliminar">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedadobj->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody><!-- Mostrar Resultados -->
            <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input href="#" class="boton-rojo-block" type="submit" value="Eliminar">
                        </form>
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>  
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</main>        