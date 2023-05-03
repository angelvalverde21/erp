<div>

    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush

    <x-breadcrumbs title="Ventas" />

    <x-sectioncontent>

        <div class="buscador d-flex justify-content-between">


            <div class="input-group mb-3 me-2">
                <input type="text" class="form-control" placeholder="Buscar" wire:model.debounce.500ms="search"
                    aria-label="Recipient's username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>

            <div class="input-group mb-3 me-2">
                <input id="fecha" type="date" class="form-control" placeholder="Buscar por fecha">
            </div>

            <div class="input-group mb-3 w-25">
                <a id="enviarfecha" href="{{ route('manage.orders', [$store->nickname]) }}"
                    class="btn btn-success w-100">Buscar</a>
            </div>

        </div>

        <script>
            var fecha = document.getElementById('fecha');
            var enlace = document.getElementById('enviarfecha');

            fecha.addEventListener('change', () => {
                console.log('El valor ha cambiado:', fecha.value); // Acción a realizar cuando cambia el valor
                enlace.href = enlace.href + '/date/' + fecha.value;
            });

            

            

        </script>

    </x-sectioncontent>

    <x-sectioncontent>

        <div class="card">

            <div class="card-header">
                @livewire('manage.orders.create-order-modal', ['user' => $orders], key('create-order-modal'))
            </div>

            <div class="card-body table-responsive">
                {{-- <h4 class="card-title">Productos</h4>
            <h6 class="card-subtitle">Productos actualmente en almacen</h6> --}}

                {{-- {{ count($orders) }}
                <hr>
                {{ count($orders2) }}
                <hr> --}}


                {{-- @foreach ($orders2 as $order)
                    {{ $order->id }}
                @endforeach --}}

                @if (count($orders) > 0)

                    <table id="example1" class="table table-striped">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Cliente</th>
                                <th>Productos</th>
                                <th>Status</th>
                                <th>Entregar por</th>
                                <th class="text-center">Status</th>
                                <th>Pago</th>
                                <th>Total</th>
                                <th>Autor</th>
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
                                {{-- Ojo is_active es un campo de la base de datos, pero is_pay es una instancia --}}
                                <tr @if (!$order->is_active) class="bg-danger" @endif

                                    @if ($order->is_delivered()) style="background: #E2FBDF;" @endif>

                                    <td class="text-center"
                                        @if ($order->is_pay()) style="background: #E2FBDF;" @endif>
                                        <a href="{{ route('manage.orders.edit', [$store->nickname, $order->id]) }}"
                                            class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <p class="mt-1">#{{ $order->id }}</p>

                                    </td>

                                    <td class="">
                                        <h6>{{ strtoupper($order->buyer->name) }}</h6>
                                        {{-- {{ $order->address }} --}}

                                        <li>DNI: {{ $order->address->dni }}</li>
                                        <li>{{ $order->address->primary }}</li>
                                        <li>{{ $order->address->secondary }}</li>
                                        <li>References: </li>
                                        <li>{{ $order->address->references }}</li>
                                        <li><strong>{{ $order->address->district->name }}</strong> -
                                            {{ $order->address->district->province->name }} -
                                            {{ $order->address->district->province->department->name }}</li>
                                        <li>{{ $order->delivery_time_start }} Hasta {{ $order->delivery_time_end }}
                                        </li>
                                        <li>{{ $order->address->phone }}</li>

                                    </td>

                                    <td class="text-center">
                                        @if ($order->is_pay())
                                            <span class="text-success" style="font-size: 1.5rem"><i
                                                    class="fa-solid fa-sack-dollar"></i></span>
                                        @else
                                            <span class="text-secondary" style="font-size: 1.5rem"><i
                                                    class="fa-solid fa-sack-dollar"></i></span>
                                        @endif
                                    </td>

                                    <td>
                                        {{-- Imanges de los productos --}}

                                        @foreach ($order->items as $item)
                                            @if (isset($item->content->image))
                                                <a href="{{ Storage::url($item->content->image) }}"
                                                    data-lightbox="show-images-preview-{{ $order->id }}">
                                                    <img style="height: 125px"
                                                        src="{{ Storage::url($item->content->image) }}" alt="">
                                                    ({{ $item->content->talla_impresa }})
                                                </a>
                                            @else
                                                Sin imagen
                                            @endif
                                        @endforeach
                                    </td>

                                    <td class="text-center">
                                        {{ $order->delivery_man->name }}
                                    </td>
                                    <td class="text-center">

                                        <p>{{ $order->print_status() }}</p>
                                        {{-- @if ($order->is_pay())
                                            <button class="btn btn-success">Pagado</button>
                                        @endif --}}
                                        {{-- @foreach ($order->status as $status)
                                            {{ $status->title }}
                                            @php
                                                break;
                                            @endphp
                                        @endforeach --}}

                                    </td>

                                    <td>{{ $order->total_amount }}</td>

                                    <td>{{ $order->total_amount }}</td>
                                    <td>{{ $order->seller->name }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td>
                                        <a href="#" wire:click="cancelOrder( {{ $order }} )"
                                            class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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
