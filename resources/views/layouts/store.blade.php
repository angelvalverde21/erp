<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- Alpine --}}

    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <!-- Google Font: Source Sans Pro -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}

    {{-- <!-- Font Awesome --> --}}

    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}"> --}}

    <!-- DataTables -->
{{-- 
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}


    <!-- Theme style -->

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    <!-- iconos FontAwesome css  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Dropzone JS --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
        integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- Dropzone  CSS --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>

            body{
                font-size: 10pt;
            }

            a:hover{
                text-decoration: none !important;
            }

            .table-detalle-transporte tr td{
                padding: .4rem;
            }

            .primer-td{
                border-top: 0px !important;
            }

            .ultimo-td{
                border-bottom: 0px !important;

            }
        </style>
        
        <style>
            .resultados ul {
                margin: 0 !important;
                padding: 0 10px !important;
            }
    
            .resultados {
                box-shadow: -2px 3px 24px 0px rgba(163, 163, 163, 1);
            }
    
            .resultados ul li {
                border-bottom: 1px solid #ccc;
                padding-bottom: 3px;
            }
        </style>


    <style>
        .error {
            color: red;
        }

        li {
            list-style: none
        }

        .dropzone {
            border-style: dashed;
            border-width: 2px;
        }


        .callout {
            padding: 15px;
            border: 1px solid #eee;
            border-left-width: 5px;
            border-radius: 3px;

            h4 {
                margin-top: 0;
                margin-bottom: 5px;
            }

            p:last-child {
                margin-bottom: 0;
            }

            code {
                border-radius: 3px;
            }

            &+.bs-callout {
                margin-top: -5px;
            }
        }

        .callout-primary {

            border-left-color: #0d6efd;

            h4 {
                color: #0d6efd;
            }
        }

        .callout-sucess {

            border-left-color: #198754;

            h4 {
                color: #198754;
            }
        }

        .callout-info {

            border-left-color: #0dcaf0;

            h4 {
                color: #0dcaf0;
            }
        }

        .callout-warning {

            border-left-color: #ffc107;

            h4 {
                color: #ffc107;
            }
        }

        .callout-danger {

            border-left-color: #dc3545;

            h4 {
                color: #dc3545;
            }
        }

        body{
            font-size: 10pt;
        }
    </style>


</head>

<body body class="hold-transition sidebar-mini">

    <div class="wrapper">

        @livewire('user.components.header')

        @livewire('user.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{ $slot }}
        </div>
        <!-- /.content-wrapper -->

        @livewire('user.components.footer')

    </div>


    @stack('modals')

    @livewireScripts

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>


    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    {{-- 
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
    {{-- <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script> --}}
    <!-- Page specific script -->

    <script>
        $(document).ready(function() {
            Livewire.on('creado', function() {

                // $('.modal').modal('hidden');

                Swal.fire(
                    'Creado!',
                    'Hemos creado el registro',
                    'success'
                ).then(function() {
                    //$(".modal-backdrop").hide();
                    // //$(".modal").hide();
                    // $('.modal').removeClass('show');
                    // $('body').removeClass('modal-open');
                    // $('.modal').hide();
                    // $('body').remove('modal-backdrop');

                    // $(".modal").each(function() {
                    //     $(this).toggle();
                    // });
                    console.log('Creado: se ha pulsado ok en sweetalert2');
                });

            })
        });
    </script>

    <script>
        window.addEventListener('cerrar-modal', event => {

            // $(".modal").each(function() {
            //     $(this).hide();
            // });
            
            $(event.detail.modalID).modal('hide');

            
            console.log('el modal que vamos a cerrar es: ' + event.detail.modalID);
        })
    </script>

    <script>
        Livewire.on('actualizado', function() {
            Swal.fire(
                'Actualizado!',
                'Se ha guardado los datos',
                'success'
            )
        });
    </script>

    <script>
        Livewire.on('eliminado', function() {
            Swal.fire(
                'Borrado!',
                'Se ha borrado el registro',
                'success'
            )
        });
    </script>
    @livewireStyles

    {{-- datepicker --}}
    
    {{-- fin de date picker --}}
    
    @stack('script')

    {{-- Js font-awesome --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
