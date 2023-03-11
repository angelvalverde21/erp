<div>

    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush

    <x-breadcrumbs title="Productos" icon="fa-solid fa-barcode"/>

    <x-sectioncontent>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('manage.productions.create', [$store->nickname]) }}"
                    class="btn btn-primary">Agregar
                    Produccion</a>
            </div>

            {{-- {{ $store->id }}
            {{ $store->nickname }} --}}
            <!-- /.card-header -->
            <div class="card-body table-responsive">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre del producto</th>
                            <th>Inversion</th>
                            <th>Stock</th>
                            <th>Publicado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Inversion</th>
                            <th>Stock</th>
                            <th>Publicado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($productions as $production)
                            <tr>
                                <td>{{ $production->id }}</td>
                                <td>{{ $production->name }}</td>
                                <td>S/. {{ $production->amount }}</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{ route('manage.productions.edit', [$store->nickname, $production->id]) }}"
                                            class="btn btn-success mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        {{-- <a href="#" wire:click.prevent="deleteProduct({{ $production->id }})" class="btn btn-secondary"><i
                                                class="fa-solid fa-trash"></i></a> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>


            </div>
            <!-- /.card-body -->
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
                    "buttons": ["pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>
    @endpush
</div>