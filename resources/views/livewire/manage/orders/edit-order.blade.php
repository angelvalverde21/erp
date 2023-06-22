<div>

    <x-sectioncontent>
        {{-- @livewire('manage.orders.edit-order.card-status-iconos', ['order' => $order], key('card-status-iconos')) --}}
    </x-sectioncontent>

    @if (!$order->is_active)
        <x-sectioncontent>
            <div class="activar d-flex justify-content-center mb-3">
                <button type="button" class="btn btn-success" wire:click="reactivarOrden()"><i
                        class="fa-solid fa-bolt"></i> Reactivar Orden</button>
            </div>
        </x-sectioncontent>
    @endif

    <x-sectioncontent>
        {{-- Botones para impresion print --}}
        @include('livewire.manage.orders.edit-order._navbar-buttons')

    </x-sectioncontent>

    <x-sectioncontent>

        <div class="row">

            <div class="col-lg-3">@include('livewire.manage.orders.edit-order._navbar-delivery-type')</div>

            {{-- Payment method  --}}
            <div class="col-lg-3">@include('livewire.manage.orders.edit-order._navbar-collect-methods')</div>

            {{-- Payment method  --}}
            <div class="col-lg-3">@include('livewire.manage.orders.edit-order._navbar-pay-method')</div>

            {{-- Delivery Man (Persona que entregara el paquete) --}}
            <div class="col-lg-3">@include('livewire.manage.orders.edit-order._navbar-delivery-man')</div>

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


                <div class="col-12 col-lg-4">

                    {{-- Transportista --}}
                    @livewire('manage.orders.edit-order.card-carrier-details', ['order' => $order], key('card-carrier-' . $order->address_id))

                    {{-- Hora y fecha de entrega --}}
                    @livewire('manage.orders.edit-order.card-date-details', ['order' => $order], key('card-details'))

                </div>


                <div class="col-12 col-lg-4">

                    @livewire('manage.orders.edit-order.card-shipping-cost', ['order' => $order], key('card-carrier-cost-' . $order->address_id))
                    
                </div>




                {{-- resumen de envio --}}
                {{-- <div class="col-12 col-lg-3">

                    <ul class="list-group">
                        <li class="list-group-item">Metodo entrega: {{ $order->delivery_method->title }}</li>
                        <li class="list-group-item">Metodo de Cobro: {{ $order->collect_method->title }}</li>
                        <li class="list-group-item">Metodo de Pago: {{ $order->payment_method->name }}</li>
                        <li class="list-group-item">Encargado del envio: {{ $order->delivery_man->name }}</li>
                    </ul>
                    
                </div> --}}

            </div>
        @endif

        <style>
            .table> :not(:first-child) {
                border-top: 0px solid !important;
            }
        </style>

        {{-- Item de la orden --}}

        @livewire('components.items.show-item-all', ['order' => $order], key('card-show-all-items'))


        <div class="row">

            {{-- Costos del transporte --}}

            <div class="col-12 col-lg-8">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
        
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
        
                            <li class="nav-item">
                                <a class="nav-link active" id="comprobatesPago-tab" data-toggle="pill" href="#comprobatesPago"
                                    role="tab" aria-controls="comprobatesPago" aria-selected="true">Pagos</a>
                            </li>
        
                            <li class="nav-item">
                                <a class="nav-link" id="comprobantesEmpaque-tab" data-toggle="pill" href="#comprobantesEmpaque"
                                    role="tab" aria-controls="comprobantesEmpaque" aria-selected="false">Empaque
                                    ({{ $order->comprobantesEmpaque->count() }})</a>
                            </li>
        
                            <li class="nav-item">
                                <a class="nav-link" id="comprobantesEnvio-tab" data-toggle="pill" href="#comprobantesEnvio"
                                    role="tab" aria-controls="comprobantesEnvio" aria-selected="false">Envio
                                    ({{ $order->comprobantesEnvio->count() }})</a>
                            </li>
        
                        </ul>
        
                    </div>
        
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
        
                            <div class="tab-pane fade show active" id="comprobatesPago" role="tabpanel"
                                aria-labelledby="comprobatesPago-tab">
                                @livewire('manage.orders.edit-order.card-show-invoice', ['order' => $order], key('card-show-invoice'))
        
                            </div>
        
                            <div class="tab-pane fade" id="comprobantesEmpaque" role="tabpanel"
                                aria-labelledby="comprobantesEmpaque-tab">
        
                                @livewire('manage.orders.edit-order.card-comprobantes-empaque', ['order' => $order], key('card-comprobantes-empaque'))
        
                            </div>
        
                            <div class="tab-pane fade" id="comprobantesEnvio" role="tabpanel"
                                aria-labelledby="comprobantesEnvio-tab">
                                @livewire('manage.orders.edit-order.card-comprobantes-envio', ['order' => $order], key('card-comprobantes-envio'))
        
                            </div>
        
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
        
            </div>


            {{-- Detalles del pago --}}
            <div class="col-lg-4 col">
                @livewire('manage.orders.edit-order.card-show-summary', ['order' => $order], key('show-summary'))
            </div>

        </div>

        {{-- @livewire('manage.orders.edit-order.card-comprobantes', ['order' => $order->id], key('card-comprobantes')) --}}

    </x-content>

    {{-- Modal para las observaciones --}}

</div>
