@props([
    'id',               // id único del recurso
    'route',            // ruta del form
    'title' => 'Eliminar registro',
    'message' => '¿Estás seguro que querés eliminar este elemento?',
    'button' => 'Eliminar',
    'label' => 'Eliminar'
])

<!-- Botón para abrir el modal -->
<x-danger-button data-bs-toggle="modal" data-bs-target="#modalDelete{{ $id }}">
    {{ $label }}
</x-danger-button>

<!-- Modal Bootstrap -->
<div class="modal fade" id="modalDelete{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body">
                <h5 class="modal-title font-bold text-xl mb-2">{{ $title }}</h5>
                <p>{{ $message }}</p>
            </div>

            <div class="modal-footer border-0">
                <x-primary-button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </x-primary-button>

                <form action="{{ $route }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <x-danger-button class="w-100">{{ $button }}</x-danger-button>
                </form>
            </div>

        </div>
    </div>
</div>
