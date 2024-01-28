<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregarProductos(Request $request)
    {
        try {
            if (!$request->has('cliente_id')) {
                $result = [
                    'ok' => false,
                    'message' => 'No se proporcionó el cliente_id.',
                ];
                return json_encode($result);
            }
            $cliente = Cliente::find($request->cliente_id);
            if (!$request->has('productos')) {
                $result = [
                    'ok' => false,
                    'message' => 'No se proporcionaron productos para agregar.',
                ];
                return json_encode($result);
            }

            // Crear un nuevo carrito y asociarlo con el cliente
            $carrito = new Carrito();
            $carrito->cliente_id = $cliente->cliente_id;
            $total = 0.00;
            $carrito->total = $total;

            $carrito->save();



            // Iterar sobre los productos enviados
            foreach ($request->productos as $producto) {
                // Verificar si el producto existe
                $productoModel = Producto::find($producto['producto_id']);
                if (!$productoModel) {
                    $result = [
                        'ok' => false,
                        'message' => 'Uno de los productos no existe.',
                    ];
                    return json_encode($result);
                }

                // Verificar si hay suficiente cantidad disponible
                if ($productoModel->cantidad < $producto['cantidad']) {
                $result = [
                    'ok' => false,
                    'message' => 'La cantidad solicitada del producto "'.$productoModel->nombre.'" no está disponible.',
                ];
                return json_encode($result);
                }
                // Actualizar la cantidad del producto
                $productoModel->cantidad -= $producto['cantidad'];
                $productoModel->save();

                // Agregar el producto al carrito
                $carrito->productos()->attach($producto['producto_id'], ['cantidad' => $producto['cantidad'], 'precio' => $productoModel->precio]);
                $total += $productoModel->precio * $producto['cantidad'];
            }

            $carrito->total = $total;
            $carrito->save();

            $result = [
                'ok' => true,
                'message' => 'Agregado con exito el carrito'
            ];

            return json_encode($result);

        } catch (\Exception $e) {
            // Capturar cualquier excepción y devolver un mensaje de error
            $result = [
                'ok' => false,
                'message' => 'Ha ocurrido un error: ' . $e->getMessage(),
            ];
            return json_encode($result);
        }
    }

}
