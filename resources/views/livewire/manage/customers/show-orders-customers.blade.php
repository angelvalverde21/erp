<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    {{-- <x-breadcrumbs title="Ordenes: {{ $user->name }}" /> --}}

    <x-sectioncontent>

        <div class="card">
            <div class="card-body">

                <div class="content-btns d-flex justify-content-between">
                    <a href="#" wire:click.prevent="createOrder()" class="btn btn-success">Crear Order</a>

                <a href="{{ route('manage.customers.edit', [$store->nickname, $user->id]) }}" class="btn btn-secondary">Ver Usuario</a>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">

                @include('livewire.manage.orders._show-orders-table', ['orders' => $orders])

            </div>
        </div>

        

    </x-sectioncontent>

</div>
