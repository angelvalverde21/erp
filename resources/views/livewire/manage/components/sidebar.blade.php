<div>

    <style>
        .separador-sidebar {
            background: #858585;
            width: 100%;
            height: 0.50px;
        }

        .nav-sidebar>.nav-item .nav-icon {
            font-size: 0.9rem !important;
        }

        .user-panel {
            font-size: 0.9rem !important;
        }
    </style>


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->

        <!-- Sidebar -->
        <div class="sidebar">


            <div class="logo-store px-3 pt-3 text-center">
                @if ($store->getOption('upload_logo') != '')
                    <img width="100px" src="{{ $store->getOption('upload_logo') }}" alt="">
                @else
                    <h3>SU LOGO AQUI</h3>
                @endif
            </div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-between text-white">

                <div class="image">
                    <img src="{{ asset('admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>

                <div class="info">
                    <div class="name text-end">
                        <a href="{{ route('home') }}" class="d-block">{{ $user->name }} </a>
                    </div>

                    <div class="rol text-end">
                        @if ($user->hasRole('admin'))
                            (admin)
                        @endif
                    </div>

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

                {{-- menu --}}

                {{-- {{ $menus }} --}}


                @foreach ($menus as $menu)
                    {{-- Si hay submenu le quitamos el slug --}}
                    @if (isset($menu['sub_menu']))
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="info">
                                <a href="#" class="d-block"><i class="{{ $menu['icon'] }} mr-2"></i>
                                    {{ $menu['name'] }}</a>
                            </div>
                        </div>
                    @else
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="info">
                                <a href="{{ $menu['slug'] }}" class="d-block"><i class="{{ $menu['icon'] }} mr-2"></i>
                                    {{ $menu['name'] }}</a>
                            </div>
                        </div>
                    @endif



                    <!-- sub menu -->

                    <nav class="mt-2">

                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu"
                            data-accordion="">

                            @if (isset($menu['sub_menu']))
                                @foreach ($menu['sub_menu'] as $sub_menu)
                                    <li class="nav-item">
                                        <a href="{{ $sub_menu['slug'] }}"
                                            class="nav-link {{ request()->routeIs('manage.' . $sub_menu['active'], [$store->nickname]) ? 'active' : '' }}">
                                            {{-- class="nav-link {{ request()->routeIs('manage.'.$sub_menu['active'].'*', [$store->nickname]) ? 'active' : '' }}"> --}}
                                            <i class="{{ $sub_menu['icon'] }} nav-icon"></i>
                                            <p>{{ $sub_menu['name'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                        </ul>
                    </nav>
                @endforeach

                {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('manage.profile', [$store->nickname]) }}" class="d-block"><i
                                class="fa-solid fa-store mr-2"></i> {{ $store->name }}</a>
                    </div>
                </div> --}}

                <!-- sub menu -->

                {{-- <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu" data-accordion="">

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

                        <li class="nav-item">
                            <a href="{{ route('manage.customers', [$store->nickname]) }}"
                                class="nav-link {{ request()->routeIs('manage.customers*', [$store->nickname]) ? 'active' : '' }}">
                                <i class="fa-solid fa-users nav-icon"></i>
                                <p>Mis clientes</p>
                            </a>
                        </li>

                    </ul>
                </nav> --}}

                {{-- herramientas --}}
                {{-- 
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('manage.profile', [$store->nickname]) }}" class="d-block"><i
                                class="fa-solid fa-store mr-2"></i> Herramientas</a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu" data-accordion="">

                        <li class="nav-item">
                            <a href="{{ route('manage.productions', [$store->nickname]) }}"
                                class="nav-link {{ request()->routeIs('manage.productions*', [$store->nickname]) ? 'active' : '' }}">
                                <i class="fa-solid fa-align-justify nav-icon"></i>
                                <p>Mis producciones</p>
                            </a>
                        </li>

                    </ul>
                </nav>

                <hr class="separador-sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('manage.web', [$store->nickname]) }}" class="d-block"><i
                                class="fa-solid fa-store mr-2"></i> web</a>
                    </div>


                </div> --}}

                {{-- fin de herramientas --}}


                {{-- <li class="nav-item"> --}}
            @else
                {{-- fin de else --}}
                <!-- Sidebar Menu -->

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="{{ route('account') }}" class="d-block"><i
                                class="fa-solid fa-store mr-2"></i>Paginas</a>
                    </div>
                </div>

                <nav class="mt-2">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu" data-accordion="">
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

                            <a href="{{ route('account.store.create') }}" class="nav-link"><i
                                    class="fa-solid fa-box nav-icon"></i>Crear nueva pagina</a>

                        </li>

                    </ul>
                </nav>
            @endif


        </div>
        <!-- /.sidebar -->



    </aside>

</div>
