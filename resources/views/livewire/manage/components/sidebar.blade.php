<div>

    <style>
        .separador-sidebar {
            background: #858585;
            width: 100%;
            height: 0.50px;
        }
    </style>


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('home') }}" class="d-block">{{ $user->name }}</a>
                </div>
            </div>

            @if (isset($store->nickname))
                <!-- SidebarSearch Form -->

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('manage.profile', [$store->nickname]) }}" class="d-block"><i
                                class="fa-solid fa-store mr-2"></i> {{ $store->name }}</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu" data-accordion="">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ route('manage.orders', [$store->nickname]) }}"
                                class="nav-link {{ request()->routeIs('manage.orders*', [$store->nickname]) ? 'active' : '' }}">
                                <i class="fa-solid fa-align-justify nav-icon"></i>
                                <p>Mis ventas</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('manage.products', [$store->nickname]) }}"
                                class="nav-link {{ request()->routeIs('manage.products*', [$store->nickname]) ? 'active' : '' }}">
                                <i class="fa-solid fa-box nav-icon"></i>
                                <p>Mis productos</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="{{ route('user.purchases') }}"
                                class="nav-link {{ Route::is('user.purchases') ? 'active' : '' }}">
                                <i class="fa-solid fa-bag-shopping nav-icon"></i>
                                <p>
                                    Mis compras
                                    
                                </p>
                            </a>
                        </li> --}}

                        <hr class="separador-sidebar">

                        <li class="nav-item">
                            <a href="{{ route('manage.customers', [$store->nickname]) }}"
                                class="nav-link {{ request()->routeIs('manage.customers*', [$store->nickname]) ? 'active' : '' }}">
                                <i class="fa-solid fa-users nav-icon"></i>
                                <p>Mis clientes</p>
                            </a>
                        </li>

                        <hr class="separador-sidebar">

                        {{-- <li class="nav-item">
                            <a href="{{ route('manage.profile', [$store->nickname]) }}"
                                class="nav-link {{ Route::is('user.profile') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user nav-icon"></i>
                                <p>
                                    Mi cuenta
                                </p>
                            </a>
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="{{ route('user.profile') }}"
                                class="nav-link {{ Route::is('user.profile') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user nav-icon"></i>
                                <p>
                                    Otros
                                    
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>


                <li class="nav-item">

                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="{{ route('manage.web', [$store->nickname]) }}" class="d-block"><i
                                    class="fa-solid fa-store mr-2"></i> web</a>
                        </div>


                    </div>
                @else
                    <!-- Sidebar Menu -->

                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="{{ route('account') }}" class="d-block"><i class="fa-solid fa-store mr-2"></i>Paginas</a>
                        </div>
                    </div>
      
                    <nav class="mt-2">

                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu"
                            data-accordion="">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                            {{-- <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa-solid fa-align-justify nav-icon"></i>
                                    <p>Mis ventas</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa-solid fa-box nav-icon"></i>
                                    <p>Mis productos</p>
                                </a>
                            </li>

                            <hr class="separador-sidebar"> --}}
                            <li class="nav-item">

                                <a href="{{ route('account.store.create') }}" class="nav-link"><i class="fa-solid fa-box nav-icon"></i>Crear nueva pagina</a>
      
                            </li>

                        </ul>
                    </nav>
            @endif


        </div>
        <!-- /.sidebar -->



    </aside>

</div>
