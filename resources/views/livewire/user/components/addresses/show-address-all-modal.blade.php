<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#show-all-address-modal">
        Editar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="show-all-address-modal" tabindex="-1" aria-labelledby="show-all-address-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="show-all-address-modalLabel">Agregar o editar direccion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @livewire('user.components.addresses.show-address-all', ['user_id' => $user_id], key('show-addresses-all-' . $user_id))

                </div>

                <div class="modal-footer">
                    {{-- Boton para cerrar --}}
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- Boton para Guardar los cambios --}}
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

</div>
