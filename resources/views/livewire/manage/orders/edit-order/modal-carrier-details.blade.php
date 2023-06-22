<div>

    <style>
        .input-group-text{
            padding: 0 5px 0 10px !important;
            background-color: #fff !important;
        }

        .form-control{
            border-left: 0 !important;
            padding-left: 5px !important; 
        }
    </style>

    <div class="row">

        {{-- <div class="col col-lg-6">
            <x-form.select label="Trasladado por" wirevalue="order.delivery_man_id" icon="fa-solid fa-person-biking">
                @foreach ($repartidores as $repartidor)
                    <option value="{{ $repartidor->id }}">{{ $repartidor->name }}
                    </option>
                @endforeach
            </x-form.select>
        </div> --}}

        {{-- <div class="col-lg-6 col">
            <x-form.select label="Metodo de pago" wirevalue="order.payment_list_method_id" icon="fa-solid fa-money-bill">
                @foreach ($order->paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->id }}">
                        {{ $paymentMethod->name }}</option>
                @endforeach
            </x-form.select>
        </div> --}}

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">

        <div class="mb-5 p-4 bg-white shadow-sm">
            {{-- <h3>Linear stepper</h3> --}}
            <div id="stepper1" class="bs-stepper linear">
                <div class="bs-stepper-header" role="tablist">


                    @if ($order->shipping_cost_to_carrier > 0)
                        <div class="step active" data-target="#test-l-1">
                    @else
                        <div class="step" data-target="#test-l-1">
                    @endif
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger1"
                                aria-controls="test-l-1" aria-selected="true">
                                <span class="bs-stepper-circle"><li class="fa-solid fa-user"></li></span>
                                <span class="bs-stepper-label">Envio</span>
                            </button>
                        </div>

                    <div class="bs-stepper-line"></div>

                    @if ($order->shipping_cost_carrier > 0)
                        <div class="step active" data-target="#test-l-2">
                    @else
                        <div class="step" data-target="#test-l-2">
                    @endif

                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger2"
                            aria-controls="test-l-2" aria-selected="false">
                            <span class="bs-stepper-circle"><i class="fa-solid fa-motorcycle"></i></span>
                            <span class="bs-stepper-label">Translado</span>
                        </button>
                    </div>

                    <div class="bs-stepper-line"></div>

                    @if ($order->shipping_cost_buyer > 0)
                        <div class="step active" data-target="#test-l-3">
                    @else
                        <div class="step" data-target="#test-l-3">
                    @endif

                        <button type="button" class="step-trigger" role="tab" id="stepper1trigger3"
                            aria-controls="test-l-3" aria-selected="false">
                            <span class="bs-stepper-circle"><i class="fa-solid fa-truck"></i></span>
                            <span class="bs-stepper-label">Agencia</span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="stepper2" class="bs-stepper linear">
                <div class="bs-stepper-header" role="tablist">
                    <div class="step active" data-target="#test-l-1">
                        <x-form.input-number wirevalue="order.shipping_cost_to_carrier" texticon="S/."
                            error="Este campo es requerido">
                            0.00
                        </x-form.input-number>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-2">
                        <x-form.input-number wirevalue="order.shipping_cost_carrier" texticon="S/."
                            error="Este campo es requerido">
                            0.00
                        </x-form.input-number>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-l-3">
                        <x-form.input-number wirevalue="order.shipping_cost_buyer" texticon="S/."
                            error="Este campo es requerido">
                            0.00
                        </x-form.input-number>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-6 col-12">
            <x-form.input-number wirevalue="order.shipping_cost_to_carrier" label="Costo de traslado hasta el courier"
                icon="fa-solid fa-truck" error="Este campo es requerido">
                0.00
            </x-form.input-number>
        </div>

        <div class="col-lg-6 col-12">

            <x-form.input-number wirevalue="order.shipping_cost_carrier" label="Costo cobrado por el courier"
                icon="fa-solid fa-truck" error="Este campo es requerido">
                0.00
            </x-form.input-number>

        </div>
        <div class="col-lg-12 col-12">

            <x-form.input-number wirevalue="order.shipping_cost_buyer" label="Costo cobrado al cliente"
                icon="fa-solid fa-user" error="Este campo es requerido">
                0.00
            </x-form.input-number>

        </div> --}}

    </div>

    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
        wire:click.prevent="saveOrder()" class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>
        Guardar</button>

    <div class="spinner-border" wire:loading.inline-flex wire:target="saveOrder" role="status">
        <span class="sr-only">Loading...</span>
    </div>

</div>
