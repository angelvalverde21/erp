<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush

    <x-breadcrumbs title="{{ $user->name }}" icon="fa-solid fa-user" />

    <x-sectioncontent>

      <div class="row mb-3">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              @livewire('components.addresses.show-address-all', ['user' => $user->id, 'model_refer' => 'User', 'model_refer_id' => $user->id, 'render' => 'render'], key('show-addresses-all-' . $user->id))
            </div>
          </div>
          
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
              <h1>Roles</h1>
            </div>
            <div class="card-body">
              @livewire('manage.roles.show-roles', ['user' => $user], key($user->id))
            </div>
          </div>
        </div>
      </div>

    </x-sectioncontent>

    <x-sectioncontent>

        <div class="row">
            <div class="col-lg-6 col-12">
                {{-- @livewire('components.addresses.show-address-all', ['user' => $user->id, 'model_refer' => 'User', 'model_refer_id' => $user->id], key('show-addresses-store-' . $store->id)) --}}
                {{-- @livewire('components.addresses.show-address', ['address' => $user->address_id, 'model_refer'=>'User', 'model_refer_id'=>$user->id], key('show-address-customer-' . $user->address_id)) --}}
                
            </div>
            <div class="col-lg-6 col-12"></div>
        </div>

    </x-sectioncontent>

    <x-sectioncontent>

      @livewire('manage.customers.show-orders-customers', ['customer' => $user], key($user->id))

    </x-sectioncontent>


    {{-- <x-sectioncontent>
        <div class="card">

            <div class="card-body table-responsive">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Nombre</th>

                            <th>Monto</th>
                            <th>Status</th>
                            <th>cliente desde</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>

                                <td>{{ $order->buyer->name }}</td>

                                <td>{{ $order->total_mount }}</td>
                                <td>ENTREGADO</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{ route('manage.orders.edit', [$store->nickname, $order->id]) }}"
                                            class="btn btn-success mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-secondary"><i
                                                class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>


            </div>
            <!-- /.card-body -->
        </div>

    </x-sectioncontent> --}}


    @push('script-footer')

        <!-- DataTables  & Plugins -->
        <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('admin-lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script>
            $(function() {
                $("#example1").DataTable({
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
    @endpush
</div>
