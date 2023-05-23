<nav class="navbar navbar-expand-lg">

    <li class="nav-item active mr-2 mt-2">
        <a class="btn btn-outline-success"
            href="{{ route('manage.customers.edit', [$store->nickname, $order->buyer_id]) }}"><i
                class="fa-solid fa-user"></i>
            {{ $order->buyer->name }} ({{ $order->buyer->totalOrders() }})</a>
    </li>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mt-2" id="navbarNav">

        <ul class="navbar-nav ml-auto d-flex align-self-center">

            <li class="nav-item active">
                <div class="dropdown ">
                    <button class="btn btn-outline-info w-100 my-1 dropdown-toggle" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-print mr-2 pt-1"></i> Imprimir
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start dropdown-menu-right"
                        aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" target="_blank" href="{{ route('manage.orders.print.invoice', [$store->nickname, $order->id]) }}"><i class="fa-solid fa-clipboard-list mr-1"></i>
                                Orden de compra</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" target="_blank"
                                href="{{ route('manage.orders.print.packing-label', [$store->nickname, $order->id]) }}" target="_blank"><i
                                    class="fa-solid fa-box-open mr-1"></i>
                                Rotulado</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" target="_blank"
                                href="{{ route('manage.orders.print.voucher', [$store->nickname, $order->id]) }}"><i
                                    class="fa-solid fa-receipt mr-2 pt-1"></i> Voucher</a></li>
                    </ul>
                </div>
            </li>

            {{-- <li class="nav-item active">
                <a class="btn btn-outline-info d-flex mx-1 my-1" href="#"><i
                        class="fa-solid fa-mobile-screen mr-2 pt-1"></i> Contactar<span class="sr-only"><i
                            class="fa-solid fa-mobile-screen"></i> Contactar</span></a>
            </li> --}}

            <li class="nav-item active">
                <a class="btn btn-outline-info d-flex my-1" data-toggle="modal" data-target="#observations-modal"
                    href="#"><i class="fa-solid fa-message mr-2 pt-1"></i>
                    Observaciones</a>
            </li>


            {{-- Current --}}
            @push('script')
                <script>
                    // enviando datos al servidor
                    document.addEventListener('livewire:load', function() {
                        @this.current = current;
                        console.log(current);
                    })
                </script>
            @endpush







            {{-- <li class="nav-item active">

                <a class="btn btn-outline-info d-flex mx-1 my-1"
                    href="{{ route('manage.orders.print.voucher', [$store->nickname, $order->id]) }}"></a>

            </li> --}}

        </ul>
    </div>

</nav>

<nav>
    
    <li class="nav-item d-flex justify-content-between w-100 mb-2 mt-1">
        <div class="registrado">Registrado: {{ $order->created_at }}</div>
        <div class="actualizado">Ultima Actualizacion: {{ $order->updated_at }}</div>
    </li>
    
</nav>

<x-modal title="Observaciones" id="observations-modal">

    <div class="row">
        <div class="col-lg-12">
            <x-form.textarea wirevalue="order.observations_time" id="o1"
                label="Observaciones de la entrega (Horario)" icon="fa-solid fa-lock">
                Observaciones de la entrega (Horario)
            </x-form.textarea>

            <x-form.textarea wirevalue="order.observations_public" id="o2" label="Observaciones publicas"
                icon="fa-solid fa-unlock">
                Observaciones publicas
            </x-form.textarea>
            <x-form.textarea wirevalue="order.observations_private" id="o3" label="Observaciones internas"
                icon="fa-solid fa-lock">
                Observaciones Internas
            </x-form.textarea>
        </div>
        <div class="col-lg-12"></div>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-info" wire:loading.attr="disabled" wire.target="save"
            wire:click="saveObservations"><i class="fa-solid fa-floppy-disk mr-1"></i> Guardar
        </button>
    </x-slot>

</x-modal>
