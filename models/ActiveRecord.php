<?php

namespace Model;

class ActiveRecord{
    //DB
    protected static $db;
    //Columnas de nuestra tabla
    protected static $columnasDB = [];
    protected static $tabla = '';
    //Errores (Validacion)
    protected static $errores = [];

    
    

    public function guardar(){
        if ($this->id) {
            //Actualizar
            $this->actualizar();
        }
        else{
            //Creando nuevo registro
            $this->crear();
        }
    }

    //Guardar datos regresa un true como resultado
    public function crear(){
        //Sanitizar datos
        $atributos = $this->sanitizarDatos();
         //Insertar datos a DB
        //Query concatenado usando keys del arreglo asociativo de $atributos y sus values para ahorrar codigo
        $query = "INSERT INTO " . static::$tabla  . " (";
            $query .= join(', ',array_keys($atributos));
            $query .= " ) VALUES (' ";
            $query .= join("', '",array_values($atributos));
            $query .= "')";

            //Query ejecutado
            $resultado = self::$db->query($query);
            if ($resultado) {
                //Redireccionar
                header('Location: /admin?resultado=1');
            }
    }

    public function actualizar(){
        //Sanitizar datos
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .= join(', ', $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) ."' ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar
            header('Location: /admin?resultado=2');
        }
    }

    //Eliminar un registro
    public function eliminar(){
        //Elimina la propiedad
        $queryDelete = "DELETE FROM " . static::$tabla . " WHERE id = ". self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($queryDelete);
        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }


    }

    //Identificar y unir los atributos de la DB usando el arreglo de las columnas
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna){
            if ($columna === 'id') {
                continue;
            }
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //Sanitizar datos de la DB
    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
             $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        //Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivo
    public function borrarImagen(){
        //Eliminar el archivo (imagen)
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);   
        }
    }

    //Definir conexion a la DB Y UTILIZARLA EN ESTA CLASE (SETTER)
    public static function setDB($database){
        self::$db = $database;
    }

    //Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        
        static::$errores = [];
        return static::$errores;

    }


    /* CONSULTAR DATOS (PRINCIPIOS CON ACTIVE RECORD)*/
    //Lista todos los registros
    public static function all(){
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;

    }
    //Obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;

    }

    public static function consultarSQL($query){
        //consultar la base de datos
        $resultado = self::$db->query($query);
        //Iterar resultados
        $array = [];
        //While loop para asignar valores obtenidos por medio de un fetch assoc de una tabla
        while($registro = $resultado->fetch_assoc()){
            //Convierte de arreglo assoc a objeto con crearObjeto
            $array[] = static::crearObjeto($registro);
        }
        //liberar memoria
        $resultado->free();

        //retornar resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        //Crea nueva instancia de la misma clase
        $objeto = new static;
        //Foreach Loop a todos los registros obtenidos del fetch assoc de la tabla
        foreach($registro as $key => $value){
            //Checa si existe una la propiedad $key en el $objeto
            if (property_exists($objeto, $key)) {
                //Le asigna un valor al campo de la llave del arreglo asociativo
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    /* CONSULTAR DATOS */

    //Busca registro por su id
    public static function find($id){
        $queryPropiedad = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultarSQL($queryPropiedad);
        return array_shift($resultado);
    }

    //Sincroniza el objeto en memoria con los datos realizados por el usuario
    public function sincronizar($args = []){
        foreach($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key = $value;
            }
        }
    }
}

?>