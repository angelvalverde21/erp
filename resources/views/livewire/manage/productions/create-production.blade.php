<div>
    
    <x-breadcrumbs title="Crear Produccion" />

    <x-sectioncontent>

        <div class="card">

            <div class="card-body">
                <form action="#">
                    <div class="form-body">

                        <hr>
                        
                        <div class="row p-t-20">

                            <div class="col-md-9">
                                <x-form.input type="text" wirevalue="production.name" debounce="500"
                                    error="Este campo es requerido">
                                    Nombre de la produccion
                                </x-form.input>
                            </div>

                            <!--/span-->
                            <div class="col-md-3">
                                <x-form.input type="number" wirevalue="production.amount"
                                    error="Este campo es requerido">
                                    Monto a invertir
                                </x-form.input>
                            </div>
                            <!--/span-->

                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <x-form.input disabled="disabled" type="text" wirevalue="production.slug"
                                    error="este producto ya existe">
                                    Url Automatico
                                </x-form.input>
                            </div>

                        </div>
                        <!--/row-->


                    </div>

                    <div class="botones">
                        <div class="form-actions">
                            <button type="button" wire:loading.attr="disabled" wire.target="save"
                                wire:click="save" class="btn btn-success"> <i class="fa fa-check"></i> Crear
                                Producto</button>
                            <button type="button" class="btn btn-inverse">Cancel</button>
                        </div>

                        <div wire:loading wire:target="save" class="spinner-borderx" role="status">
                            <span class="sr-onlyx">Espere...</span>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </x-sectioncontent>


</div>
