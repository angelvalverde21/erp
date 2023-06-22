<div>
    <div class="card">

        <div class="card-header">

            <div class="d-flex justify-content-between align-items-center">
                <div class="title d-flex align-items-center">
                    <i class="fa-solid fa-truck mr-2"></i> <span>Enviar por:</span>
                </div>
                <x-form.button-open-modal target="#editCarrierOrder" />
            </div>
        </div>
        
        <div class="card-body py-3">

            <style>
                .carrier{
                    position: relative;
                }

                .logo-carrier{
                    position: absolute;
                    right: 10px;
                    bottom: 0px;
                    z-index: 100;
                    width: 25%
                }
            </style>

            <div class="carrier">
                <div class="details">
                    @if ($order->carrier_address)
                    <li><h4>{{ $order->carrier_address->title }}</h4></li>
                    <li>{{ $order->carrier_address->name }}</li>
                    <li>{{ $order->carrier_address->phone }}</li>
                    <li>{{ $order->carrier_address->primary }}</li>
                    <li>{{ $order->carrier_address->secondary }}</li>
                    <li>{{ $order->carrier_address->district->name }} -
                        {{ $order->carrier_address->district->province->name }} -
                        {{ $order->carrier_address->district->province->department->name }}</li>
                    @else
                        No hay courier, debe seleccionar uno
                    @endif
                </div>
                <div class="logo-carrier">
                    <img src="{{ $order->carrier_address->user->getOption('logo_profile') }}" width="100%">
                </div>
            </div>



        </div>

    </div>

    <x-modal title="editar transportista" id="editCarrierOrder" size="modal-lg">

        @livewire('components.carriers.show-carrier-all', ['order' => $order], key('show-carrier-all-' . $order->id))

        <x-slot name="footer">

        </x-slot>

    </x-modal>


</div>
