<div>
    {{-- Success is as dangerous as failure. --}}

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-album">
        <i class="fa-solid fa fa-square-plus mr-2"></i>Crear Album
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="add-album" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar Album</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="#">
                        <div class="form-body">
    
                            <hr>
                            
                            <div class="row p-t-20">
    
                                <div class="col-md-12">
                                    <x-form.input type="text" wirevalue="album.name" debounce="500"
                                        error="Este campo es requerido">
                                        Nombre de Album
                                    </x-form.input>
                                </div>
    
                                <!--/span-->
                                <div class="col-md-12">
                                    <x-form.textarea wirevalue="album.description"
                                        error="Este campo es requerido">
                                        Descripcion
                                    </x-form.textarea>
                                </div>
                                <!--/span-->
    
                            </div>


    
                        </div>
    
                        <div class="botones">
                            <div class="form-actions">
                                <button type="button" wire:loading.attr="disabled" wire.target="save"
                                    wire:click="save" class="btn btn-success"> <i class="fa fa-check"></i> Crear
                                    Album</button>
                                <button type="button" class="btn btn-inverse">Cancel</button>
                            </div>
    
                            <div wire:loading wire:target="save" class="spinner-borderx" role="status">
                                <span class="sr-onlyx">Espere...</span>
                            </div>
                        </div>
    
    
                    </form>


                </div>
            </div>
        </div>

    </div>
</div>
