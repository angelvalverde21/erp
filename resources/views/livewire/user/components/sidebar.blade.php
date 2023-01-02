<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <style>
        .separador-sidebar {
            color: #ffffff;
        }
    </style>


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('user') }}" class="brand-link">
            <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">ARA</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->

            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('user') }}" class="d-block">{{ $this->user->name }}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu" data-accordion="">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



                    <li class="nav-item">

                        <a href="{{ route('user.sales') }}"
                            class="nav-link {{ Route::is('user.sales') ? 'active' : '' }}">
                            <i class="fa-solid fa-money-bill-wave nav-icon"></i>
                            <p>
                                Mis ventas
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="{{ route('user.products') }}"
                            class="nav-link {{ Route::is('user.products') ? 'active' : '' }}">
                            <i class="fa-solid fa-database nav-icon"></i>
                            <p>
                                Mis Productos
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="{{ route('user.purchases') }}"
                            class="nav-link {{ Route::is('user.purchases') ? 'active' : '' }}">
                            <i class="fa-solid fa-bag-shopping nav-icon"></i>
                            <p>
                                Mis compras
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

                    </li>

                    <hr class="separador-sidebar">

                    <li class="nav-item">

                        <a href="{{ route('user.profile') }}"
                            class="nav-link {{ Route::is('user.profile') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-group nav-icon"></i>
                            <p>
                                Mis clientes
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

                    </li>

                    <hr class="separador-sidebar">

                    <li class="nav-item">

                        <a href="{{ route('user.profile') }}"
                            class="nav-link {{ Route::is('user.profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user nav-icon"></i>
                            <p>
                                Mi cuenta
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

                    </li>

                    
                    <li class="nav-item">

                        <a href="{{ route('user.profile') }}"
                            class="nav-link {{ Route::is('user.profile') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user nav-icon"></i>
                            <p>
                                Otros
                                {{-- <i class="right fas fa-angle-left"></i> --}}
                            </p>
                        </a>

                    </li>
                </ul>
            </nav>



        </div>
        <!-- /.sidebar -->
    </aside>


</div>
