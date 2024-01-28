<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $primaryKey = 'cliente_id';
    public $timestamps = false;
    protected $fillable = [
    'cliente_id', 'ruc_dni','nombres','apellidos','email','direccion','estado','url'
    ];

    public function carritos()
    {
        return $this->hasMany(Carrito::class, 'cliente_id', 'cliente_id');
    }
}
