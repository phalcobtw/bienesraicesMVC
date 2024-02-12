<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id','titulo','precio','imagen',
    'descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []){
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? 1;
    }
    public function validar(){
        if (!$this->titulo) {
            self::$errores[] = 'Debes añadir un titulo';
        }
        if (!$this->precio) {
            self::$errores[] = 'El precio es obligatorio';
        }
        if (!$this->descripcion) {
            self::$errores[] = 'La descripcion es obligatoria';
        }
        if (!$this->habitaciones) {
            self::$errores[] = 'Introduzca una cantidad de habitaciones';
        }
        if (!$this->wc) {
            self::$errores[] = 'Introduzca una cantidad de wc';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'Introduzca una cantidad de estacionamientos';
        }
        /* if (!$this->vendedores_id) {
            self::$errores[] = 'Introduzca un vendedor';
        } */
        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;

    }
}