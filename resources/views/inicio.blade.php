<x-app-layout>
    <x-jet-section-title>
        <x-slot name="title"><p class="py-1 px-1 text-3xl font-semibold">Restaurante</p></x-slot>
        <x-slot name="description"></x-slot>
    </x-jet-section-title>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="md:px-4 md:grid md:grid-cols-2 lg:grid-cols-3 gap-5 space-y-4 md:space-y-0 py-8">
                    <x-card-inicio>
                        <x-slot name="header">
                            <img src="{{ asset('images/add.png') }}" alt="">
                        </x-slot>
                        Nueva Factura
                        <x-slot name="footer">
                            <a href="{{ route('nuevafactura') }}"
                            class="mt-4 text-xl w-full text-white bg-green-700 hover:bg-green-500 py-2 px-8 rounded-xl shadow-lg">Ir</a>
                        </x-slot>

                    </x-card-inicio>
                    <x-card-inicio>
                        <x-slot name="header">
                            <img src="{{ asset('images/cuenta.png') }}" alt="">
                        </x-slot>
                        Ver Facuras
                        <x-slot name="footer">
                            <a href="facturas"
                            class="mt-4 text-xl w-full text-white bg-green-700 hover:bg-green-500 py-2 px-8 rounded-xl shadow-lg">Ir</a>
                        </x-slot>

                    </x-card-inicio>
                    <x-card-inicio>
                        <x-slot name="header">
                            <img src="{{ asset('images/menu.png') }}" alt="">
                        </x-slot>
                        Productos
                        <x-slot name="footer">
                            <a href="{{ route('productos') }}"
                            class="mt-4 text-xl w-full text-white bg-green-700 hover:bg-green-500 py-2 px-8 rounded-xl shadow-lg">Ir</a>
                        </x-slot>

                    </x-card-inicio>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
