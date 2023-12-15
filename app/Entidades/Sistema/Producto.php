<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [
        'idproducto', 'nombre', 'cantidad', 'precio', 'descripcion', 'imagen',
        'fk_idcategoria'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
        $this->nombre = $request->input('txtNombre');
        $this->cantidad = $request->input('txtCantidad');
        $this->precio = $request->input('txtPrecio');
        $this->descripcion = $request->input('txtDescripcion');
        $this->imagen = "";
        $this->fk_idcategoria = $request->input('lstCategoria');
    }

    public function obtenerTodos()
    {
    $sql = "SELECT 
        p.idproducto, 
        p.nombre, 
        p.cantidad, 
        p.precio, 
        p.descripcion, 
        p.imagen,
        p.fk_idcategoria,
        c.nombre as categoria
        FROM productos p
        JOIN categorias c ON p.fk_idcategoria = c.idcategoria";

    $lstRetorno = DB::select($sql);
    return $lstRetorno;
    }


    public function obtenerPorId($idProducto)
    {
        $sql = "SELECT 
        idproducto, 
        nombre, 
        cantidad, 
        precio, 
        descripcion, 
        imagen,
        fk_idcategoria FROM productos WHERE idproducto = $idProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio = $lstRetorno[0]->precio;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->fk_idcategoria = $lstRetorno[0]->fk_idcategoria;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE productos SET
        nombre = '?',
        cantidad = ?,
        precio = ?,
        descripcion = '?',
        imagen = '?',
        fk_idcategoria = ?
        WHERE idproducto = ?";
        $affected = DB::update($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->descripcion,
            $this->imagen,
            $this->fk_idcategoria
        ]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE idproducto =?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO productos(
            nombre,
            cantidad,
            precio,
            descripcion,
            imagen,
            fk_idcategoria
            ) VALUES (?, ?, ?, ?, ?, ?)";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->descripcion,
            $this->imagen,
            $this->fk_idcategoria
        ]);
        return $this->idproducto = DB::getpdo()->lastInsertId();
    }
}
