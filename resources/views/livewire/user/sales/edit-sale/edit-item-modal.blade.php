<div>
    {{-- Do your work, then step back. --}}

    <!-- Button trigger modal -->
    <a style="font-size: 15pt;" wire:click.prevent="editItem({{ $item->id }})" href="#"><i
            class="fa-solid fa-pen-to-square" data-toggle="modal" data-target="#exampleModalCenter">></i></a>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="mb-3">
                                {{ $item->id }}
                                <input type="text" class="form-control" id="inputName" wire:model="itemedit.name"
                                        aria-describedby="nameHelp" placeholder="Descripcion">
                                @error('itemedit.name')
                                    <span class="error">Este campo es requerido</span>
                                @enderror

                            </div>
                        </div>

                        <div class="col-lg-6 col-6">
                            <div class="mb-3">
                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Talla Virtual</span>
                                    <input type="text" class="form-control" id="inputPrecio" wire:model="itemedit.talla"
                                        aria-describedby="nameHelp" placeholder="Talla">
                                </div>
                                @error('itemedit.price')
                                    <span class="error">indique el precio</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-6 col-6">
                            <div class="mb-3">
                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">S/.</span>
                                    <input type="number" class="form-control" id="inputPrecio" wire:model="itemedit.price"
                                        aria-describedby="nameHelp" placeholder="0.00">
                                </div>
                                @error('itemedit.price')
                                    <span class="error">indique el precio</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-info" wire:loading.attr="disabled" wire.target="save"
                        wire:click="save"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar Cambios</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {{-- El wire.loading.attr y el wire.target funcionan juntos --}}

                </div>

                {{-- <div class="modal-footer-2">
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled" wire.target="test"
                        wire:click="test">Test</button>
                </div> --}}

            </div>
        </div>
    </div>
    {{-- fin de modal --}}

</div>
