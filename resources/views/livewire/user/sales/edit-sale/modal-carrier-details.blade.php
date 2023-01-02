<div>

    <div class="row">

        <div class="col col-lg-12">
            <x-user.select wirevalue="order.delivery_man_id" icon="fa-solid fa-person-biking">
                @foreach ($repartidores as $repartidor)
                    <option value="{{ $repartidor->id }}">{{ $repartidor->name }}
                    </option>
                @endforeach
            </x-user.select>
        </div>

        <div class="col-lg-12 col">
            <x-user.select wirevalue="order.payment_method_id" icon="fa-solid fa-money-bill">
                @foreach ($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->id }}">
                        {{ $paymentMethod->name }}</option>
                @endforeach
            </x-user.select>
        </div>

        
        <div class="col-lg-6 col">

            <x-user.input-number wirevalue="order.shipping_cost_carrier" label="Costo de envio real" icon="fa-solid fa-truck"
            error="Este campo es requerido">
            0.00
        </x-user.input-number>

        </div>
        <div class="col-lg-6 col">

            <x-user.input-number wirevalue="order.shipping_cost_buyer" label="Costo cobrado al cliente" icon="fa-solid fa-user"
            error="Este campo es requerido">
            0.00
        </x-user.input-number>

        </div>

    </div>

    <button type="button" wire:loading.class="btn-secondary" wire:loading.attr="disabled" wire.target="save"
        wire:click.prevent="saveOrder()" class="btn btn-success ml-auto"><i class="fa-solid fa-floppy-disk mr-1"></i>
        Guardar</button>

    <div class="spinner-border" wire:loading.inline-flex wire:target="saveOrder" role="status">
        <span class="sr-only">Loading...</span>
    </div>

</div>
