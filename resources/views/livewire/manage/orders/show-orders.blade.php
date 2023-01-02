<div>

    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush

    <x-breadcrumbs title="Ventas" />

    <x-sectioncontent>

        <div class="card">

            <div class="card-header">
                @livewire('manage.orders.create-order-modal', ['user' => $orders], key('create-order-modal'))
            </div>

            <div class="card-body table-responsive">
                {{-- <h4 class="card-title">Productos</h4>
            <h6 class="card-subtitle">Productos actualmente en almacen</h6> --}}

                @if (count($orders) > 0)

                    <table id="example1" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Cliente</th>
                                <th>Entregar por</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Creado</th>
                                <th>Actualizado</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        {{-- <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Cliente</th>
                                <th>Entregar por</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Creado</th>
                                <th>Actualizado</th>
                                <th>Editar</th>
                            </tr>
                        </tfoot> --}}
                        <tbody>

                            @foreach ($orders as $order)
                                {{-- {{ $order }} --}}

                                <tr>
                                    <td class="text-center">{{ $order->id }} </td>
                                    <td class="text-center">
                                        {{ $order->buyer->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $order->delivery_man->name }}
                                    </td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->total_mount }}</td>
                                    <td>{{ $order->created_at }} ({{$order->seller->name}})</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td>
                                        <div class="d-flex  justify-content-center">
                                            <a href="{{ route('manage.orders.edit', [$store->nickname, $order->id]) }}"
                                                class="btn btn-success mr-2">Editar</a>
                                            <a href="#" class="btn btn-danger"><i
                                                    class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                @else
                    No hay registros disponibles
                @endif
            </div>
        </div>
    </x-sectioncontent>

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
                    "ordering": false,
                    "buttons": ["pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
    @endpush


</div>
