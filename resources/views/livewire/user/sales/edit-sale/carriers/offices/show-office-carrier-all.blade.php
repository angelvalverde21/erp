{{-- user.sales.edit-sale.carrier.show-carrier-all --}}
<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card">
        <div class="card-body">
            <a href="" class="btn btn-primary">Agregar Nuevo</a>
        </div>
    </div>

    @foreach ($carriers as $carrier)


        <div class="card">

            <div class="card-header">
                <strong>{{ $carrier->name }}</strong>
            <div class="card-body">

                <table class="table">
                    <tr>
                        <td>Oficina: {{ $carrier->name }}</td>
                        <td><a href="#" class="btn btn-success float-right">+</a></td>
                    </tr>
                    <tr>
                        <td>Oficina: {{ $carrier->name }}</td>
                        <td><a href="#" class="btn btn-success float-right">+</a></td>
                    </tr>
                    <tr>
                        <td>Oficina: {{ $carrier->name }}</td>
                        <td><a href="#" class="btn btn-success float-right">+</a></td>
                    </tr>
                </table>

                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        @livewire('user.sales.edit-sale.carriers.create-carrier', ['carrier_id' => $carrier->id], key('create-offices-carrier-' . $carrier->id]))
                    </div>
                </div>

            </div>

            <div class="card-footer">
                <a class="btn btn-dark float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Agregar Sucursal
                  </a>
            </div>

            <input type="hidden" wire:model="order.address_id">

        </div>
    @endforeach

</div>
