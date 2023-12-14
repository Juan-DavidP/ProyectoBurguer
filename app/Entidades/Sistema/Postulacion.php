<?php

namespace App\Entidades\Sistema;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion', 'nombre', 'apellido', 'telefono', 'direccion', 'correo',
        'curriculum'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idpostulacion = $request->input('id') != "0" ? $request->input('id') : $this->idpostulacion;
        $this->nombre = $request->input('txtNombre');
        $this->apellido = $request->input('txtApellido');
        $this->telefono = $request->input('txtTelefono');
        $this->direccion = $request->input('txtDireccion');
        $this->correo = $request->input('txtCorreo');
        $this->curriculum = "";
    }

    public function obtenerTodos()
    {
        $sql = "SELECT 
        , 
        nombre, 
        cantidad, 
        precio, 
        descripcion, 
        imagen,
        fk_idcategoria FROM productos";
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
