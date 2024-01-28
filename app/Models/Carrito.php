<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $table = "carrito";
    protected $primaryKey = "carrito_id";
    public $timestamps = false;
    protected $fillable = [
        'total','cliente_id'
        ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'carrito_producto', 'carrito_id', 'producto_id')->withPivot('cantidad', 'precio');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'cliente_id');
    }
}
