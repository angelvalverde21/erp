<div>
    {{-- Do your work, then step back. --}}
    <div>
        <div class="card">

            <div class="card-header">
                <x-form.button-open-modal class="primary" text='Agregar Precio' target="#editCarrierOrderDetails" />
            </div>


            <div class="card-body">

                <table class="table table table-striped">

                    <thead>
                        <tr>
                            <th>Id</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">x</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">=</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Creado</th>
                            <th class="text-center">Delete</th>
                        </tr>
                    </thead>

                    @foreach ($prices as $price)
                        <tr>
                            <td>{{ $price->id }}</td>
                            <td class="text-center">{{ $price->quantity }}</td>
                            <td class="text-center">x</td>
                            <td class="text-center">S/. {{ $price->value }}</td>
                            <td class="text-center">=</td>
                            <td class="text-center">S/. {{ $price->quantity*$price->value }}</td>
                            <td class="text-center">{{ $price->created_at }}</td>
                            <td class="text-center">
                                <a href="#" wire:click.prevent="deletePrice({{ $price->id }})" class="btn btn-danger"><i
                                    class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>

        </div>

        <x-modal title="Precio de venta" id="editCarrierOrderDetails" size="modal-lg">


            <form action="">

                <div class="row">

                    <div class="col-4 col-lg-4">
                        <label for="">Cantidad</label>
                        <input class="form-control" placeholder="0" type="number" id="" step="1" wire:model.debounce.500ms="quantity">
                    </div>

                    <div class="col-4 col-lg-4">
                        <label for="">Precio Unitario</label>
                        <input class="form-control" placeholder="0.00" type="number" id="" step="0.01" wire:model.debounce.500ms="price">
                    </div>

                    <div class="col-4 col-lg-4">
                        <label for="">Total Oferta</label>
                        <input class="form-control" placeholder="0.00" type="number" id="" step="0.01" wire:model.debounce.500ms="price_total">
                    </div>

                </div>

            </form>

            <x-slot name="footer">
                <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
                wire:click.prevent="createPrice()" class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>
                Guardar</button>
            </x-slot>

        </x-modal>

    </div>



</div>
