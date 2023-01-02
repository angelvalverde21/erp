<div>

    <section class="content-header">

        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <li class="nav-item active mr-2 mt-2">
                    <a class="btn btn-outline-success" href="#"><i class="fa-solid fa-user"></i>
                        {{ $order->buyer->name }} (5)</a>
                </li>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-2" id="navbarNav">
                    <ul class="navbar-nav ml-auto d-flex align-self-center">
                        <li class="nav-item active">
                            <a class="btn btn-outline-info d-flex mx-1 my-1" href="#"><i
                                    class="fa-solid fa-mobile-screen mr-2 pt-1"></i> Contactar<span class="sr-only"><i
                                        class="fa-solid fa-mobile-screen"></i> Contactar</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="btn btn-outline-info d-flex mx-1 my-1" data-toggle="modal"
                                data-target="#observations-modal" href="#"><i
                                    class="fa-solid fa-message mr-2 pt-1"></i> Observaciones</a>
                        </li>

                        <li class="nav-item active">
                            <a class="btn btn-outline-info d-flex mx-1 my-1"
                                href="{{ route('user.sales') . '/' . $order->id . '/print/voucher' }} "><i
                                    class="fa-solid fa-receipt mr-2 pt-1"></i> Voucher</a>
                        </li>

                        <li class="nav-item active">
                            <div class="dropdown">
                                <button class="btn btn-outline-info mx-1 my-1 dropdown-toggle" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-print mr-2 pt-1"></i> Imprimir
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="fa-solid fa-clipboard-list mr-1"></i> Orden de compra</a></li>
                                    <div class="dropdown-divider"></div>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="fa-solid fa-box-open mr-1"></i> Rotulado</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <style>
                    .progress {
                        height: 1.5rem !important;
                        border-radius: .5rem;
                        font-size: 0.9rem;
                    }
                </style>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">ENTREGADO </div>
                </div>


            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">

                </ol>
            </div>
            <div class="col-sm-4">
                <x-user.select wirevalue="order.delivery_method_id" icon="fa-solid fa-truck"
                    wirechange="changeDeliveryMethod()">
                    @foreach ($delivery_methods as $delivery_method)
                        <option value="{{ $delivery_method->id }}">
                            {{ $delivery_method->name }}</option>
                    @endforeach
                </x-user.select>
            </div>
        </div>

    </section>

    {{-- Alertas u observaciones de la orden --}}
    <section class="content">
        <div class="container-fluid">

            @if ($order->observations_time)
                <div class="alert alert-warning" role="alert">
                    <div>
                        <i class="fa-solid fa-clock mr-2"></i> {{ $order->observations_time }}
                    </div>
                </div>
            @endif

            @if ($order->observations_public)
                <div class="alert alert-warning" role="alert">
                    <div>
                        {{ $order->observations_public }}
                    </div>
                </div>
            @endif

        </div>
    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="row x">

                {{-- usuario --}}
                {{-- <div class="col col-lg-6">
                    @livewire('user.sales.edit-sale.card-user-details', ['user' => $order->buyer_id], key('card-user-details' . $order->buyer_id))
                </div> --}}

                {{-- fecha de entrega --}}

            </div>

            @if ($order->delivery_method_id == 1)
                <div class="row">
                    {{-- Direccion de envio --}}
                    <div class="col col-lg-6" x-data="{ shipping_method: 1 }">
                        {{-- <input type="text" x-model="shipping_method"> --}}
                        @livewire('user.sales.edit-sale.addresses.show-address-default', ['order' => $order], key('show-addresses-' . $order->address_id))
                    </div>

                    {{-- Transportista --}}
                    <div class="col col-lg-6">
                        @livewire('user.sales.edit-sale.card-carrier-details', ['order' => $order], key('card-carrier-' . $order->address_id))
                    </div>

                    {{-- Shipping Details --}}
                    {{-- <div class="col col-lg-4">
                        @livewire('user.sales.edit-sale.card-shipping-details', ['order' => $order], key('card-shipping-' . $order->address_id))
                    </div> --}}
                </div>
            @endif


            <style>
                .table> :not(:first-child) {
                    border-top: 0px solid !important;
                }
            </style>

            {{-- Item de la orden --}}

            @livewire('user.sales.edit-sale.items.card-show-all-items', ['order' => $order->id], key('card-show-all-items'))


            <div class="row">

                <div class="col col-lg-7">
                    @livewire('user.sales.edit-sale.card-date-details', ['order' => $order->id], key('card-details'))
                </div>
            

                {{-- Detalles del pago --}}
                <div class="col-lg-5 col">
                    @livewire('user.sales.edit-sale.show-summary', ['order' => $order->id], key('show-summary'))
                </div>

            </div>

            @livewire('user.sales.edit-sale.card-comprobantes', ['order' => $order->id], key('card-comprobantes'))


        </div>

    </section>

    {{-- Modal para las observaciones --}}

    <x-user.modal title="Observaciones" id="observations-modal">

        <div class="row">
            <div class="col-lg-12">
                <x-user.textarea wirevalue="order.observations_time" id="o1"
                    label="Observaciones de la entrega (Horario)" icon="fa-solid fa-lock">
                    Observaciones de la entrega (Horario)
                </x-user.textarea>

                <x-user.textarea wirevalue="order.observations_public" id="o2"
                    label="Observaciones publicas" icon="fa-solid fa-unlock">
                    Observaciones publicas
                </x-user.textarea>
                <x-user.textarea wirevalue="order.observations_private" id="o3"
                    label="Observaciones internas" icon="fa-solid fa-lock">
                    Observaciones Internas
                </x-user.textarea>


            </div>
            <div class="col-lg-12"></div>
        </div>

        <x-slot name="footer">
            <button type="button" class="btn btn-info" wire:loading.attr="disabled" wire.target="save"
                wire:click="saveObservations"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
            </button>
        </x-slot>

    </x-user.modal>




</div>
