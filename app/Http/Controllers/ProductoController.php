<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    private function reglas(?Producto $p = null): array
    {
        return [
            'codigo'        => ['required', 'max:30', Rule::unique('producto', 'codigo')->ignore($p?->id_producto, 'id_producto')],
            'nombre'        => 'required|max:100',
            'categoria'     => 'required|in:Teléfono,Accesorio,Repuesto',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta'  => 'required|numeric|gte:precio_compra',
            'stock'         => 'required|integer|min:0',
            'estado'        => 'sometimes|in:Activo,Inactivo',
        ];
    }

    public function index(Request $r) #Buscador
    {
        $productos = Producto::query()
            ->when($r->q, fn ($q, $v) => $q->where(fn ($w) => $w->where('codigo', 'like', "%$v%")->orWhere('nombre', 'like', "%$v%")))
            ->when($r->categoria, fn ($q, $v) => $q->where('categoria', $v))
            ->when($r->estado !== 'Todos', fn ($q) => $q->where('estado', $r->estado ?? 'Activo'))
            ->orderBy('codigo')->paginate(10)->withQueryString();

        return view('productos.index', compact('productos'));
    }

    public function create() { return view('productos.form', ['producto' => new Producto]); }
    public function show(Producto $producto) { return view('productos.show', compact('producto')); }
    public function edit(Producto $producto) { return view('productos.form', compact('producto')); }

    public function store(Request $r)
    {
        Producto::create($r->validate($this->reglas()) + ['fecha_registro' => today()]);
        return to_route('productos.index')->with('ok', 'Producto creado');
    }

    public function update(Request $r, Producto $producto)
    {
        $producto->update($r->validate($this->reglas($producto)));
        return to_route('productos.index')->with('ok', 'Producto actualizado');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete(['estado' => 'Inactivo']);
        return to_route('productos.index')->with('ok', 'Producto eliminado');
    }
}