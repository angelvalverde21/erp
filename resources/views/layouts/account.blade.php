<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    {{-- Empieza los estilos propios del theme --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/fontawesome-free/css/all.min.css') }}">

    @stack('script-header')

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->

    

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    
    <style>
        .has-danger{
            color: red;
        }

        li{
            list-style: none;
        }
    </style>
    
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('admin-lte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        @livewire('account.comunes.header')

        @livewire('manage.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            {{ $slot }}

        </div>
        <!-- /.content-wrapper -->

        {{-- @livewire('manage.components.footer') --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin-lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->

    @stack('script-footer')

    <!-- AdminLTE App -->

    <script src="{{ asset('admin-lte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('admin-lte/dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('admin-lte/dist/js/pages/dashboard.js') }}"></script> --}}

    {{-- Empieza los archivos necesarios para livewire --}}

    @stack('modals')

    @livewireScripts

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

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
</body>

</html>
