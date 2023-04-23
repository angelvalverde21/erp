<div>

    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush

    <x-breadcrumbs title="Productos" icon="fa-solid fa-barcode"/>

    <x-sectioncontent>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('manage.products.create', [$store->nickname]) }}"
                    class="btn btn-primary">Agregar
                    producto</a>
            </div>

            {{-- {{ $store->id }}
            {{ $store->nickname }} --}}
            <!-- /.card-header -->
            <div class="card-body table-responsive">

                <table id="example" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Imagen</th>
                            <th>Nombre del producto</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Publicado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Imagen</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Publicado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>


                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td class="text-center">

                                    @if ($product->images->count() or $product->colors->count())

                                    {{-- {{ $product->colors->count() }} --}}

                                    {{-- http://erp.test/storage/old_uploads/0a081c_dsc0013.JPG --}}
                                    {{-- http://erp.test/storage/old_uploads/colors/06dda4_5.jpg --}}

                                        <a href="{{ route('manage.products.edit', [$store->nickname, $product->id]) }}">
                                            <img width="75" src="{{ Storage::url('old_uploads/'.$product->image()) }}" alt="">
                                        </a>
                                        {{-- {{ Storage::url($color->image->name) }} --}}
                                    @else

                                        <a style="color: rgb(100, 100, 100);"
                                            href="{{ route('user.products.edit', [$store->nickname, $product->id]) }}"><span
                                                style="font-size: 50px;"><i
                                                    class="fa-solid fa-image"></i></span></a>

                                    @endif
                                </td>
                                <td><a href="{{ route('manage.products.edit', [$store->nickname, $product->id]) }}">{{ $product->name }}</a></td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{ route('manage.products.edit', [$store->nickname, $product->id]) }}"
                                            class="btn btn-success mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" wire:click.prevent="deleteProduct({{ $product->id }})" class="btn btn-secondary"><i
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