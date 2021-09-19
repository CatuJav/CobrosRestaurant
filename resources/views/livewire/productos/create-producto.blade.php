<div>
    <x-jet-button wire:click="$set('open',true)">
        Crear nuevo producto
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo producto
        </x-slot>
        <x-slot name="content">
            
            <div class="mb-4">
                <x-jet-label value="Nombre del producto"/>
                <x-jet-input type="text" class="w-full" wire:model='nombre' placeholder="Ej: Cerveza 200ml"/>
                {{-- Mostrar errores --}}
                <x-jet-input-error for="nombre"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Precio"/>
                <x-jet-input type="text" class="w-full" wire:model='precio' placeholder="Ej: 1.50"/>
                {{-- Mostrar errores --}}
                <x-jet-input-error for="precio"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Categoría"/>
                <select name="" id="" class="form-control" wire:model='id_categoria'>
                    <option value="0" selected hidden >Seleccione...</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="id_categoria"/>
                
                {{-- Mostrar errores --}}
              
            </div>
            {{-- {{$content}} --}}
            {{-- wire:ignore no permite que se renderice este div --}}
            <div class="mb-4" wire:ignore>
               
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">    
                Cerrar
            </x-jet-secondary-button>
            {{-- Se puede agregar remove al loading para ocultarlo mientras se ejecuta el metodo save --}}
            <x-jet-danger-button wire:click="save()" wire:loading.attr="disabled" wire:tarjet="save" class="disabled:opacity-100">
                Crear Producto    
            </x-jet-danger-button>
            {{-- Para mostrar cuando se esta guardando el post --}}
            {{-- <span wire:loading.flex wire:tarjet="save">Cargando...</span> --}}
            {{-- <span wire:loading wire:tarjet="save">Cargando...</span> --}}
        </x-slot>


    </x-jet-dialog-modal>

</div>
