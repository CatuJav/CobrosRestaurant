<?php

namespace App\Http\Livewire\Facturas;

use App\Models\Detalle;
use App\Models\Factura;
use App\Models\Pedido;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;
use phpDocumentor\Reflection\PseudoTypes\False_;

class ShowPedidos extends Component
{

    use WithPagination;
    public $factura;
    public $open=false;

    //Editar la factura
    public $open_edit=false;
    public $productos;
    public $id_producto;
    public $cantidad=1;
    protected $rules = [
        'id_producto' => 'required',
        'cantidad' => 'required|integer|min:1'

    ];

    public function mount()
    {
        $this->productos = Producto::where('activo','=','1')->get();
        $this->factura=new Factura();
    }

    public function render()
    {
        $pedidosEdit=Pedido::all();
        $facturasPendientes=Factura::where('estado','=','PENDIENTE')->orderBy('fecha_hora','desc')->get();
        $facturasPagadas=Factura::where('estado','=','PAGADO')->orderBy('fecha_hora','desc')->paginate(10);
        return view('livewire.facturas.show-pedidos',compact('facturasPendientes','facturasPagadas','pedidosEdit'));
    }

    public function edit(Factura $factura)
    {
        $this->factura=$factura;
        $this->open=true;
    }

    public function actualizarAPagado(Factura $faturaModi){
        // $this->validate();
        // $faturaModi->update(['estado'=>'PAGADO']);
        $faturaModi->estado='PAGADO';
        $faturaModi->save();
        $this->open=false;
    }
    public function actualizarANoPagado(Factura $faturaModi){
        // $this->validate();
        // $faturaModi->update(['estado'=>'PAGADO']);
        $faturaModi->estado='PENDIENTE';
        $faturaModi->save();
        $this->open=false;
    }
    public function editarPedido(Factura $pedido)
    {
        $this->productos = Producto::where('activo','=','1')->get();
        Pedido::truncate();

      if ($pedido->detalle!=null) {
        foreach ($pedido->detalle as $item) {
            Pedido::create([
                'id_producto'=>$item->id_producto,
                'cantidad'=>$item->cantidad
            ]);
        }
      }
        $this->open_edit=true;
        $this->open=false;
    }

    public function agregarAEdit()
    {
        $this->validate();
        Pedido::create(
           [ 'id_producto'=>$this->id_producto,
            'cantidad'=>$this->cantidad]
        );
        $pedidos2 = Pedido::groupBy('id_producto')
        ->selectRaw('id_producto, sum(cantidad) as cantidad')
        ->get();

        Pedido::truncate();
       foreach ($pedidos2 as $pedid) {
        Pedido::create([
            'id_producto' => $pedid->id_producto,
            'cantidad' => $pedid->cantidad
        ]);
       }
       $this->reset(['id_producto', 'cantidad']);
    }

    public function actualizarEdit(Factura $facturaModificada)
    {
        $this->open_edit=false;
       Detalle::where('id_factura','=',$facturaModificada->id)->delete();
       $pedidosEdit=Pedido::all();
       foreach ($pedidosEdit as $item) {
           Detalle::create(
               [
                   "id_producto"=>$item->id_producto,
                   "cantidad"=>$item->cantidad,
                   "id_factura"=>$facturaModificada->id
               ]
           );
       }
       Pedido::truncate();
       $this->factura=$facturaModificada;
       $this->open=true;

    }

    public function cancelarEdit()
    {
        $this->open_edit=false;
        $this->open=true;
    }

    public function deleteEdit(Pedido $pedido)
    {
        Pedido::destroy($pedido->id);
    }

}
