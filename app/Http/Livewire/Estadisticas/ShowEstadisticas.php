<?php

namespace App\Http\Livewire\Estadisticas;

use App\Models\Detalle;
use App\Models\Factura;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;

class ShowEstadisticas extends Component
{
    public $total = 0;
    public function render()
    {
        $ventasHoy = $this->ventaDiaria();
        $ventasMes = $this->ventaMensual();
        $productoMasVendido = $this->productoMasVendido();
        return view(
            'livewire.estadisticas.show-estadisticas',
            [
                'ventasHoy' => $ventasHoy,
                'ventasMes' => $ventasMes,
                'productoMasVendido' => $productoMasVendido
            ]

        );
    }

    public function ventaDiaria()
    {
        $datos = Factura::whereDate('fecha_hora', Carbon::today())->where('estado', 'PAGADO')->get();
        $this->total = 0;
        $detalles = [];
        foreach ($datos as $dato) {
            $detalles[] = $dato->detalle;
        }

        $total = 0;
        foreach ($detalles as $detalle) {
            foreach ($detalle as $item) {
                $total = $total + ($item->cantidad * $item->producto->precio);
            }
        }
        return $total;
    }
    public function ventaMensual()
    {
        $datos = Factura::whereMonth('fecha_hora', date('m'))->where('estado', 'PAGADO')->get();
        $this->total = 0;
        $detalles = [];
        foreach ($datos as $dato) {
            $detalles[] = $dato->detalle;
        }


        $total = 0;
        foreach ($detalles as $detalle) {
            foreach ($detalle as $item) {
                $total = $total + ($item->cantidad * $item->producto->precio);
            }
        }
        return $total;
    }

    public function productoMasVendido()
    {
         $idFacP = Factura::select('id')->where('estado', '=', 'PAGADO')->pluck('id');
          $datos= Detalle::whereIn('id_factura',$idFacP)->groupBy('id_producto')->selectRaw('sum(cantidad) as sum, id_producto')->orderBy('sum','desc')
         ->get();

         $cantidades=[];
         foreach ($datos as $dato) {
             $cantidades[]=intval($dato->sum);
         }
         $productosIds=[];
         foreach ($datos as $dato) {
             $productosIds[]=Producto::where('id','=',$dato->id_producto)->pluck('nombre');
         }

         //Los productos se estan ordenando y no coinciden con los valoreas
        // json_encode($productosIds);
        // $productosNombres=Producto::whereIn('id',$productosIds)->pluck('nombre');
         $union = array($cantidades,$productosIds);
         return json_encode($union);
       
      
    }
}
