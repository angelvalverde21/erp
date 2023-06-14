<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    {{-- <x-breadcrumbs title="Ordenes: {{ $user->name }}" /> --}}

        <div class="card">

            <div class="card-header py-3">
                <a href="#" wire:click.prevent="createOrder()" class="btn btn-success">Crear Order</a>
            </div>

            <div class="card-body">

                @include('livewire.manage.orders._show-orders-table', ['orders' => $orders])

            </div>
        </div>

</div>
