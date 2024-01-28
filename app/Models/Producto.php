<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'producto';
    protected $primaryKey = 'producto_id';
    public $timestamps = false;
    protected $fillable = [
        'descripcion', 'precio','foto','estado','cantidad'
    ];

    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'carrito_producto', 'producto_id', 'carrito_id')->withPivot('cantidad');
    }
}
