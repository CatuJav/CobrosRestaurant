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

    public $saldoPendiente = 0;
    public $saldoPagado = 0;
    public $total = 0;


    protected $rules = [
        'id_producto' => 'required|min:2',
        'cantidad' => 'required|numeric|min:1'

    ];

    protected $listeners = ['delete'];


    public function mount()
    {
        $this->productos = Producto::all();
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
        $pedidos = Pedido::all();
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
                'estado' => 'PAGADO'
            ]);
        } else {
            $factura = Factura::create([
                'estado' => 'PENDIENTE'
            ]);
        }

        $pedidosG=Pedido::all();
        foreach ($pedidosG as $pedidog) {
            Detalle::create([
                'id_producto'=>$pedidog->id_producto,
                'cantidad'=>$pedidog->cantidad,
                'id_factura'=>$factura->id,
            ]);
            
        }
        Pedido::truncate();
    }

    public function cancelar()
    {
        Pedido::truncate();
        return redirect()->route('inicio');
    }
}
