<div>

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

        <div class="col-lg-6 col">
            <x-form.input-number wirevalue="order.shipping_cost_to_carrier" label="Costo de traslado hasta el courier"
                icon="fa-solid fa-truck" error="Este campo es requerido">
                0.00
            </x-form.input-number>
        </div>
        <div class="col-lg-6 col">

            <x-form.input-number wirevalue="order.shipping_cost_carrier" label="Costo cobrado por el courier"
                icon="fa-solid fa-truck" error="Este campo es requerido">
                0.00
            </x-form.input-number>

        </div>
        <div class="col-lg-12 col">

            <x-form.input-number wirevalue="order.shipping_cost_buyer" label="Costo cobrado al cliente"
                icon="fa-solid fa-user" error="Este campo es requerido">
                0.00
            </x-form.input-number>

        </div>

    </div>

    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
        wire:click.prevent="saveOrder()" class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>
        Guardar</button>

    <div class="spinner-border" wire:loading.inline-flex wire:target="saveOrder" role="status">
        <span class="sr-only">Loading...</span>
    </div>

</div>
