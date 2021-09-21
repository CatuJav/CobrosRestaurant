<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Facturas') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-2 gap-5 space-y-4 md:space-y-0 py-8">
                    <x-card-inicio>
                        <x-slot name="header">
                            <h1 class="text-2xl font-semibold text-indigo-700">Pendiente</h1>
                        </x-slot>

                        <x-table>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Id
                                            {{-- Sort --}}

                                        </th>

                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                            {{-- Sort --}}

                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Observación
                                            {{-- Sort --}}

                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                            {{-- Sort --}}

                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                            {{-- Sort --}}

                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($facturasPendientes as $facturaShow)

                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->id }}</div>

                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->fecha_hora }}
                                                </div>

                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->observacion }}
                                                </div>

                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->estado }}</div>

                                            </td>
                                            <td class=" py-4 ">
                                                <x-jet-secondary-button class="text-sm underline"
                                                    wire:click='edit({{ $facturaShow }})'>Seleccionar
                                                </x-jet-secondary-button>

                                            </td>
                                    @endforeach

                                    <!-- More people... -->
                                </tbody>
                            </table>

                        </x-table>


                        <x-slot name="footer">
                            <h1>Total de facturas pendientes {{count($facturasPendientes)}}</h1>
                        </x-slot>
                    </x-card-inicio>
                    {{-- TABLA 2 --}}
                    <x-card-inicio>
                        <x-slot name="header">
                            <h1 class="text-2xl font-semibold text-green-600">Pagados</h1>
                        </x-slot>
                        <x-table>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Id
                                            {{-- Sort --}}

                                        </th>

                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                            {{-- Sort --}}

                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Observación
                                            {{-- Sort --}}

                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                            {{-- Sort --}}

                                        </th>
                                        <th scope="col"
                                            class="cursor-pointer px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                            {{-- Sort --}}

                                        </th>

                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($facturasPagadas as $facturaShow)

                                        <tr>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->id }}</div>

                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->fecha_hora }}
                                                </div>

                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->observacion }}
                                                </div>

                                            </td>
                                            <td class="px-6 py-4 ">
                                                <div class="text-sm text-gray-900">{{ $facturaShow->estado }}</div>

                                            </td>
                                            <td class=" py-4 ">
                                                <x-jet-secondary-button class="text-sm underline"
                                                    wire:click='edit({{ $facturaShow }})'>Seleccionar
                                                </x-jet-secondary-button>

                                            </td>
                                    @endforeach

                                    <!-- More people... -->
                                </tbody>
                            </table>
                            @if ($facturasPagadas->hasPages())
                                <div class="px-6 py-3">
                                    {{ $facturasPagadas->links() }}
                                </div>
                            @endif
                        </x-table>

                        <x-slot name="footer">
                            <h1></h1>
                        </x-slot>
                    </x-card-inicio>
                </div>
            </div>
        </div>
    </div>

    {{-- Edición de estados --}}
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Factura
        </x-slot>
        <x-slot name="content">

            @if ($factura != null)
                <div class="mb-4 flex">
                    <x-jet-label class="font-bold text-xl" value="N°: " />
                    <x-jet-label class="text-xl px-2" value=" {{ $factura->id }}" />

                    {{-- Mostrar errores --}}

                </div>
                <div class="mb-4 flex">
                    <x-jet-label class="font-bold text-xl" value="Fecha: " />
                    <x-jet-label class="text-xl px-2" value=" {{ $factura->fecha_hora }}" />

                    {{-- Mostrar errores --}}

                </div>
                <div class="mb-4 flex">
                    <x-jet-label class="font-bold text-xl" value="Observación: " />
                    <x-jet-label class="text-lg px-2" value=" {{ $factura->observacion }}" />

                    {{-- Mostrar errores --}}

                </div>
                <div class="mb-4 flex">
                    <x-jet-label class="font-bold text-xl" value="Estado: " />
                    @if ($factura->estado == 'PENDIENTE')
                        <x-jet-label class="px-2 text-xl  font-semibold  text-red-500"
                            value="{{ $factura->estado }}" />
                    @else
                        <x-jet-label class="px-2 text-xl  font-semibold  text-green-500"
                            value="{{ $factura->estado }}" />
                    @endif



                    {{-- Mostrar errores --}}

                </div>


                <x-table>
                    @php
                        $i = 1;
                        $total = 0;
                    @endphp
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    N°
                                </th>
                                <th scope="col"
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripción
                                </th>
                                <th scope="col"
                                    class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Precio Unitario
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cantidad
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($factura->detalle as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                {{ $i++ }}
                                            </div>

                                        </div>
                                    </td>
                                    <td class="px-2 py-4">
                                        <div class="text-sm text-gray-900">{{ $item->producto->nombre }}</div>

                                    </td>
                                    <td class="px-2 py-4">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $item->producto->precio }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $item->cantidad }}
                                    </td>
                                    <td class="px-6 py-4  text-sm text-center text-gray-500">
                                        {{ $item->producto->precio * $item->cantidad }}
                                    </td>
                                </tr>
                                @php
                                    $total += $item->producto->precio * $item->cantidad;
                                @endphp
                            @endforeach
                            <!-- More people... -->
                        </tbody>
                    </table>
                </x-table>
                <div class="px-8 text-right w-full">
                    <p class="text-2xl font-bold px-2">Total: $ {{ $total }}</p>
                </div>


            @endif

        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            {{-- Se puede agregar remove al loading para ocultarlo mientras se ejecuta el metodo save --}}
            @if ($factura != null)
                @if ($factura->estado == 'PENDIENTE')
                    <x-jet-secondary-button class="btn btn-green disabled:opacity-25"
                        wire:click="actualizarAPagado({{ $factura }})">
                        PAGADO
                    </x-jet-secondary-button>

                @else
                    <x-jet-danger-button class="disabled:opacity-25"
                        wire:click="actualizarANoPagado({{ $factura }})">
                        NO PAGADO
                    </x-jet-danger-button>
                @endif
            @endif
            {{-- Para mostrar cuando se esta guardando el post --}}
            {{-- <span wire:loading.flex wire:tarjet="save">Cargando...</span> --}}
            {{-- <span wire:loading wire:tarjet="save">Cargando...</span> --}}
        </x-slot>


    </x-jet-dialog-modal>
</div>
