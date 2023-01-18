<div>
    {{-- <x-breadcrumbs title="Editar venta" /> --}}

    {{-- Menu superior del edit-order.blade.php --}}

    {{-- @foreach ($order->status as $status)
        <li>{{ $status->name }}</li>
    @endforeach --}}



    {{-- @include('livewire.manage.orders.edit-order._navbar-status') --}}
    <x-sectioncontent>

        @livewire('manage.orders.edit-order.card-status-iconos', ['order' => $order], key('card-status-iconos'))
 
            <!-- /.col -->

            {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
              <div class="info-box">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-cog"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">CPU Traffic</span>
                  <span class="info-box-number">
                    10
                    <small>%</small>
                  </span>
                </div>
  
              </div>
 
            </div> --}}



            {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                <div class="info-box mb-3">
                    @if ($order->is_pay())
                    <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-comments-dollar"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">PAGADO</span>
                      <span class="info-box-number">S/. {{ $order->total_amount }}</span>
                    </div>        
                    @else
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fa-solid fa-comments-dollar"></i></span>
    
                    <div class="info-box-content">
                      <span class="info-box-text">PENDIENTE</span>
                      <span class="info-box-number">PAGO</span>
                    </div>
                    @endif

                </div>

              </div> --}}

            <!-- fix for small devices only -->



            <!-- /.col -->

        <!-- /.row -->
    </x-sectioncontent>

    {{-- @include('livewire.manage.orders.edit-order._navbar-status') --}}
    <x-sectioncontent>
        @include('livewire.manage.orders.edit-order._navbar-buttons')
    </x-sectioncontent>

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

        {{-- @livewire('manage.orders.edit-order.card-comprobantes', ['order' => $order->id], key('card-comprobantes')) --}}

    </x-content>

    <x-sectioncontent>

        <h3 class="mb-3">Comprobantes</h3>

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

    </x-sectioncontent>

    {{-- Modal para las observaciones --}}

</div>
