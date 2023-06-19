<div>

    <x-breadcrumbs title="Mis clientes" />


    @livewire('components.users.show-users', ['users' => $users, 'rol'=>'buyer'], key('usuarios-buyer'))

</div>
