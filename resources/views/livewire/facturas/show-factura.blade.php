<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva factura') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-jet-label value="Producto" />
        <select name="" id="" class="form-control w-full" wire:model="id_producto">
            <option value="0" selected hidden>Seleccione...</option>
            @foreach ($productos as $productoEleccion)
                <option value="{{ $productoEleccion->id }}">{{ $productoEleccion->nombre }}</option>
            @endforeach

        </select>
        <x-jet-input-error for="id_producto"/>
        <x-jet-label value="Cantidad: " />
        <x-jet-input type="text" class="w-full" wire:model='cantidad' />
        <x-jet-input-error for="cantidad"/>
        <button class="btn btn-green" wire:click="agregar">Agregar</button>


        @if (count($pedidos))
            @php
                $i = 1;
            @endphp
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                                {{-- Sort --}}

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Descripción
                                {{-- Sort --}}

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad
                                {{-- Sort --}}

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio Unitario
                                {{-- Sort --}}

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                                {{-- Sort --}}

                            </th>

                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pedidos as $pedidoShow)

                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $i++ }}</div>

                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $pedidoShow->producto->nombre }}</div>

                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $pedidoShow->cantidad }}</div>

                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $pedidoShow->producto->precio }}</div>

                                </td>

                                <td class="flex px-6 py-4 whitespace-nowrap  text-sm font-medium">
                                    {{-- Componente de anidamiento --}}
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}





                                    <a class="btn btn-red ml-2" wire:click="$emit('deletePedido',{{ $pedidoShow }})">

                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        <!-- More people... -->
                    </tbody>
                </table>
            </x-table>
            <div class="flex py-8">
                <div class="mt-1">
                    <label class="inline-flex items-center">
                      <input type="checkbox" class="form-checkbox h-6 w-6 text-green-500" wire:model='pagado'/>
                      <span class="ml-3 text-lg">Pagado</span>
                    </label>
                </div>
                <div class="w-full text-right">
                    
    
                        <p class="text-green-600 text-lg">Total pagado: {{$saldoPagado}}</p>
                        <p class="text-indigo-600 text-lg">Saldo pendiente: {{$saldoPendiente}}</p>
                        <p class="font-semibold text-3xl">Total: {{$total}}</p>
                    
                </div>
            </div>

            <a class="btn btn-green" wire:click="guardarFactura">Guardar</a>
        @else
            <x-jet-section-border/>
            <div class="px-6 py-4 text-center">Aún no hay pedidos</div>
            <x-jet-section-border/>

        @endif
        
        <button class="btn btn-red" wire:click="cancelar">Cancelar</button>
    </div>

    @push('js')
        <script>
            Livewire.on('deletePedido', pedido => {
                Swal.fire({
                    title: 'Esta seguro de elminar ' + pedido.producto.nombre + '?',
                    text: "Esto no sera reversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, borrar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        //Emitir evento desde JS a show-posts, emitiendo delete comi parametro la id del post
                        Livewire.emitTo('facturas.show-factura', 'delete', pedido);

                        Swal.fire(
                            'Borrado!',
                            pedido.producto.nombre + ' ha sido borrado',
                            'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</div>
