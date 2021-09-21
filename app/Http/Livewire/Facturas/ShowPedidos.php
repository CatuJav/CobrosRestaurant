<?php

namespace App\Http\Livewire\Facturas;

use App\Models\Factura;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPedidos extends Component
{

    use WithPagination;
    public $factura;
    public $open=false;

    
    public function mount()
    {
        $this->factura=new Factura();
    }

    public function render()
    {
        $facturasPendientes=Factura::where('estado','=','PENDIENTE')->orderBy('fecha_hora','desc')->get();
        $facturasPagadas=Factura::where('estado','=','PAGADO')->orderBy('fecha_hora','desc')->paginate(10);
        return view('livewire.facturas.show-pedidos',compact('facturasPendientes','facturasPagadas'));
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

}
