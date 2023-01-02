<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


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
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('adminpro/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- This page CSS -->

    <!-- Custom CSS -->
    <link href="{{ asset('adminpro/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('adminpro/assets/css/pages/tab-page.css') }}" rel="stylesheet">
    
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('adminpro/assets/css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Pro</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @livewire('manage.components.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @livewire('manage.components.left-sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">



                {{ $slot }}

                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->


                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                @livewire('manage.components.right-sidebar')
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer"> © 2017 Admin Pro by wrappixel.com </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('adminpro/assets/plugins/jquery/jquery.min.js') }}"></script>


    <script src="{{ asset('adminpro/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('adminpro/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('adminpro/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('adminpro/assets/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('adminpro/assets/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('adminpro/assets/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('adminpro/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('adminpro/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('adminpro/assets/js/custom.min.js') }}"></script>



    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('adminpro/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>


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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"
        integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
