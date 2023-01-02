@props(['id', 'title' => '', 'footer'=>'', 'size' => '',])
<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true" role="dialog"  style="display: none;">
    <div class="modal-dialog modal-dialog-centered {{ $size }} modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="{{ $id }}ModalTitle">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">

                {{ $slot }}

            </div>

            <div class="modal-footer">

                {{ $footer }}

                {{-- Boton para cerrar --}}
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
 
            </div>
        </div>
    </div>
</div>


