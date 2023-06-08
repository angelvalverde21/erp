<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <x-breadcrumbs title="Repartidores" />


    @livewire('components.users.show-users', ['users' => $users, 'rol' => 'repartidor'], key('usuarios-buyer'))

    <x-breadcrumbs title="Modelos" />


    @livewire('components.users.show-users', ['users' => $users, 'rol' => 'modelo'], key('usuarios-modelo'))

</div>
