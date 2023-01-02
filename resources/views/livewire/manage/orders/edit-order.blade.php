<div>
    {{-- <x-breadcrumbs title="Editar venta" /> --}}

    {{-- Menu superior del edit-order.blade.php --}}

    {{-- @foreach ($order->status as $status)
        <li>{{ $status->name }}</li>
    @endforeach --}}



    @include('livewire.manage.orders.edit-order._navbar-status')

    @include('livewire.manage.orders.edit-order._navbar-buttons')

    {{-- <x-sectioncontent>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pagination Month</h3>
            </div>
            <div class="card-body">
                <ul class="pagination pagination-month justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <p class="page-month">Lun</p>
                            <p class="page-year">14</p>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">
                            <p class="page-month">Mar</p>
                            <p class="page-year">15</p>
                        </a>
                    </li>

                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div>
        </div>
    </x-sectioncontent> --}}

    <x-sectioncontent>
        <div class="row">
            
            <div class="col-lg-4">@include('livewire.manage.orders.edit-order._navbar-delivery-type')</div>

            {{-- Payment method  --}}
            <div class="col-lg-4">@include('livewire.manage.orders.edit-order._navbar-pay-method')</div>

            {{-- Delivery Man (Persona que entregara el paquete) --}}
            <div class="col-lg-4">@include('livewire.manage.orders.edit-order._navbar-delivery-man')</div>

        </div>
    </x-sectioncontent>

    @include('livewire.manage.orders.edit-order.card-warning-alerts')
    {{-- @livewire('manage.orders.edit-order.card-warning-alerts', ['order' => $order], key('card-warning-alerts')) --}}

    {{-- Alertas u observaciones de la orden --}}

    <x-content>

        @if ($order->delivery_method_id == 1)
            <div class="row">
                {{-- Direccion de envio --}}
                <div class="col-12 col-lg-4" x-data="{ shipping_method: 1 }">
                    @livewire('components.addresses.show-address', ['address' => $order->address_id, 'model_refer' => 'Order', 'model_refer_id' => $order->id], key('show-address-' . $order->address_id))
                </div>

                {{-- Transportista --}}
                <div class="col-12 col-lg-4">
                    @livewire('manage.orders.edit-order.card-carrier-details', ['order' => $order], key('card-carrier-' . $order->address_id))
                </div>

                <div class="col-12 col-lg-4">
                    @livewire('manage.orders.edit-order.card-date-details', ['order' => $order->id], key('card-details'))
                </div>
    
            </div>
        @endif

        <style>
            .table> :not(:first-child) {
                border-top: 0px solid !important;
            }
        </style>

        {{-- Item de la orden --}}

        @livewire('components.items.show-item-all', ['order' => $order->id], key('card-show-all-items'))


        <div class="row">

            {{-- Costos del transporte --}}

            <div class="col-12 col-lg-6">
                @livewire('manage.orders.edit-order.card-shipping-cost', ['order' => $order], key('card-carrier-cost-' . $order->address_id))
            </div>


            {{-- Detalles del pago --}}
            <div class="col-lg-6 col">
                @livewire('manage.orders.edit-order.card-show-summary', ['order' => $order->id], key('show-summary'))
            </div>

        </div>

        @livewire('manage.orders.edit-order.card-comprobantes', ['order' => $order->id], key('card-comprobantes'))

    </x-content>

    {{-- Modal para las observaciones --}}

</div>
