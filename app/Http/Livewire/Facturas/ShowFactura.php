<?php

namespace App\Http\Livewire\Facturas;

use App\Models\Detalle;
use App\Models\Factura;
use App\Models\Pedido;
use App\Models\Producto;
use Livewire\Component;

use function App\View\Components\render;

class ShowFactura extends Component
{
    public $productos;
    public $id_producto, $pagado;
    public $cantidad = '1';
    public $observacion='';
    public $saldoPendiente = 0;
    public $saldoPagado = 0;
    public $total = 0;


    protected $rules = [
        'id_producto' => 'required',
        'cantidad' => 'required|integer|min:1'

    ];

    protected $listeners = ['delete'];


    public function mount()
    {
        $this->productos = Producto::where('activo','=','1')->get();
    }


    public function render()
    {

        $this->calculos();
        if ($this->pagado == 1) {
            $this->saldoPagado = $this->total;
            $this->saldoPendiente = 0;
        } else {
            $this->saldoPendiente = $this->total;
            $this->saldoPagado = 0;
        }
       // $pedidos = Pedido::all();
        $pedidos = Pedido::groupBy('id_producto')
        ->selectRaw('sum(cantidad) as cantidad, id_producto')
        ->get();
        return view('livewire.facturas.show-factura', compact('pedidos'));
    }



    public function agregar()
    {
        $this->validate();

        Pedido::create([
            'id_producto' => $this->id_producto,
            'cantidad' => $this->cantidad
        ]);

        $this->reset(['id_producto', 'cantidad']);
    }

    public function delete(Pedido $idpedido)
    {
        $idpedido->delete();
    }

    public function calculos()
    {
        $datos = Pedido::all();
        $this->total = 0;
        foreach ($datos as $dato) {
            $multipicacion = $dato->cantidad * $dato->producto->precio;
            $this->total = $this->total + $multipicacion;
        }
    }

    public function guardarFactura()
    {
        if ($this->pagado == 1) {
            $factura = Factura::create([
                'estado' => 'PAGADO',
                'observacion'=>$this->observacion!=''?$this->observacion:'Sin observación'
                
            ]);
        } else {
            $factura = Factura::create([
                'estado' => 'PENDIENTE',
                'observacion'=>$this->observacion!=''?$this->observacion:'Sin observación'
            ]);
        }

            $pedidosG = Pedido::groupBy('id_producto')
            ->selectRaw('sum(cantidad) as cantidad, id_producto')
            ->get();

        foreach ($pedidosG as $pedidog) {
            Detalle::create([
                'id_producto'=>$pedidog->id_producto,
                'cantidad'=>$pedidog->cantidad,
                'id_factura'=>$factura->id,
            ]);
            
        }
        Pedido::truncate();
        $this->reset(['pagado','observacion']);
        
    }

    public function cancelar()
    {
        Pedido::truncate();
        return redirect()->route('inicio');
    }
}
