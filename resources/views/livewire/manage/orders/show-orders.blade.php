<div>

    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush



    {{-- <x-breadcrumbs title="Ventas" /> --}}

    <x-sectioncontent>

        <div class="create-order my-3">
            @livewire('manage.orders.create-order-modal', key('create-order-modal'))

        </div>

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
                    class="btn btn-secondary w-100">Buscar</a>
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


        <div  wire:ignore.self class="accordion" id="accordionExample">
            <div class="accordion-item">

                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Entregas para Hoy
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        @include('livewire.manage.orders._show-orders-table', ['orders' => $ordersToday])

                    </div>
                </div>

            </div>

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                        Pendientes de pago
                    </button>
                </h2>

                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        @include('livewire.manage.orders._show-orders-table', ['orders' => $ordersPendientesPago])
                    </div>
                </div>

            </div>

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Pendientes de envio (Todos)
                    </button>
                </h2>

                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @include('livewire.manage.orders._show-orders-table', ['orders' => $ordersAll])
                    </div>
                </div>

            </div>
        </div>


    </x-sectioncontent>

    @push('script-footer')
        <!-- DataTables  & Plugins -->
        {{-- <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
        </script> --}}
    @endpush


</div>
