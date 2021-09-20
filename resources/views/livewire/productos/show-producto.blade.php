<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @livewire('productos.create-producto')

       <x-table>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                        ID
                        {{-- Sort --}}

                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                       >
                        Nombre
                        {{-- Sort --}}

                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                        Precio
                        {{-- Sort --}}

                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                        Categoría
                        {{-- Sort --}}

                    </th>
                    <th scope="col"
                        class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                        >
                        Acciones
                        {{-- Sort --}}

                    </th>

                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($productos as $productoShow)

                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $productoShow->id }}</div>

                        </td>
                        <td class="px-6 py-4 ">
                            <div class="text-sm text-gray-900">{{ $productoShow->nombre }}</div>

                        </td>
                        <td class="px-6 py-4 ">
                            <div class="text-sm text-gray-900">{{ $productoShow->precio }}</div>

                        </td>
                        <td class="px-6 py-4 ">
                            <div class="text-sm text-gray-900">{{ $productoShow->categoria->nombre }}</div>

                        </td>

                        <td class="flex px-6 py-4 whitespace-nowrap  text-sm font-medium">
                            {{-- Componente de anidamiento --}}
                            {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                            <a class="btn btn-green" wire:click="edit({{ $productoShow }})">
                                <i class="fas fa-edit"></i>
                            </a>



                        
                            <a class="btn btn-red ml-2" wire:click="$emit('deleteProducto',{{ $productoShow}})">

                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                <!-- More people... -->
            </tbody>
        </table>
       </x-table>
    </div>


    {{-- Edición del producto --}}
    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar producto
        </x-slot>
        <x-slot name="content">

            <div class="mb-4">
                <x-jet-label value="Nombre del producto" />
                <x-jet-input type="text" class="w-full" wire:model='producto.nombre' />
                {{-- Mostrar errores --}}
                <x-jet-input-error for="producto.nombre"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Precio" />
                <x-jet-input type="text" class="w-full" wire:model='producto.precio' />
                {{-- Mostrar errores --}}
                <x-jet-input-error for="producto.precio"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Categoría" />
                <select name="" id="" class="form-control" wire:model='producto.id_categoria'>
                   
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="producto.id_categoria"/>
                {{ $id_categoria }}
                {{-- Mostrar errores --}}
                
            </div>
            {{-- {{$content}} --}}
            {{-- wire:ignore no permite que se renderice este div --}}
          
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            {{-- Se puede agregar remove al loading para ocultarlo mientras se ejecuta el metodo save --}}
            <x-jet-danger-button wire:click="update()" wire:loading.attr="disabled" class="disabled:opacity-25">
                Actualizar
                </x-jet-danger-button>
                {{-- Para mostrar cuando se esta guardando el post --}}
                {{-- <span wire:loading.flex wire:tarjet="save">Cargando...</span> --}}
                {{-- <span wire:loading wire:tarjet="save">Cargando...</span> --}}
        </x-slot>


    </x-jet-dialog-modal>
@push('js')
<script>
   Livewire.on('deleteProducto',producto=>{
    Swal.fire({
        title: 'Esta seguro de elminar '+producto.nombre+'?',
        text: "Esto no sera reversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, borrar!'
    }).then((result) => {
        if (result.isConfirmed) {
            //Emitir evento desde JS a show-posts, emitiendo delete comi parametro la id del post
            Livewire.emitTo('productos.show-producto','delete',producto);

            Swal.fire(
                'Borrado!',
                producto.nombre+' ha sido borrado',
                'success'
            )
        }
    })
   })
</script>
@endpush
</div>
