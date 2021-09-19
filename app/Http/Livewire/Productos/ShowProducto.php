<?php

namespace App\Http\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class ShowProducto extends Component
{
    
    public $categorias,$nombre,$precio,$id_categoria;
    public $open_edit=false;

    protected $rules=[
        'producto.nombre'=>'required|min:2',
        'producto.precio'=>'required|numeric',
        'producto.id_categoria'=>'required'
    ];
    
    protected $listeners=['render'=>'render','delete'];

    public function mount()
    {
       $this->categorias=Categoria::all();
       $this->prducto=new Producto();
    }
    public function render()
    {
        $productos=Producto::all();
        return view('livewire.productos.show-producto',compact('productos'));
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
        $producto->delete();
    }
}
