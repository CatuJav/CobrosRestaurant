<?php

namespace App\Http\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProducto extends Component
{
    use WithPagination;
    public $categorias,$nombre,$precio,$id_categoria, $productoNUevo;
    public $open_edit=false;

    protected $rules=[
        'producto.nombre'=>'required|min:2',
        'producto.precio'=>'required|numeric',
        'producto.id_categoria'=>'required'
    ];
    
    protected $listeners=['render'=>'render','delete'];
    public $readyToLoad=false;
    public function loadProductos()
    {
        $this->readyToLoad=true;
    }
    public function mount()
    {
       $this->categorias=Categoria::where('activo','=','1')->get();
      
    }
    public function render()
    {
        $productos=Producto::where('activo','=','1')->paginate(10);
        return view('livewire.productos.show-producto',[
            'productos' => $this->readyToLoad
                ? $productos
                : [],
        ]);
    }

    public function edit(Producto $producto)
    {
        $this->open_edit=true;
        $this->producto=$producto;

    }

    public function update()
    {
        $this->validate();

       $this->producto->save();
        $this->reset([
            'open_edit'
        ]);
    }

    public function delete(Producto $producto)
    {
        $producto->activo='0';
        $producto->save();
    }
}
