<?php

namespace App\Http\Livewire\Productos;

use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;

class CreateProducto extends Component
{
    public $open=false;

    public $categorias,$nombre,$precio,$id_categoria;
    public $producto;
   

    protected $rules=[
        'nombre'=>'required|min:2',
        'precio'=>'required|numeric',
        'id_categoria'=>'required'
    ];


    public function mount()
    {
       $this->categorias=Categoria::where('activo','=','1')->get();
    }

    public function render()
    {
        return view('livewire.productos.create-producto');
    }

    public function save()
    {
        $this->validate();
        Producto::create([
            'nombre'=>$this->nombre,
            'precio'=>$this->precio,
            'id_categoria'=>$this->id_categoria
        ]);

        $this->reset([
            'nombre','precio','id_categoria'
        ]);
        $this->emitTo('productos.show-producto','render');
    }

    
}
