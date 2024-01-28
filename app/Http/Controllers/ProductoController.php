<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('estado','=','1')->get();
        return response()->json($productos);
    }
}
