<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">



                <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="{{ asset('adminpro/assets/images/users/profile.png') }}" alt="user" /><span class="hide-menu">{{ $store->name }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="javascript:void()">Mi Perfil </a></li>
                        <li><a href="javascript:void()">My Balance</a></li>
                        <li><a href="javascript:void()">Inbox</a></li>
                        <li><a href="javascript:void()">Account Setting</a></li>
                        <li><a href="javascript:void()">Logout</a></li>
                    </ul>
                </li>
                <li class="nav-devider"></li>
                <li class="nav-small-cap">STORE</li>

                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Mis Productos <span class="label label-rouded label-themecolor pull-right">4</span></span></a>
                    <ul aria-expanded="false" class="collapse">

                        <li><a href="{{ route('manage.products',[$store->nickname]) }}">Todos</a></li>
                        <li><a href="{{ route('manage.products.create',[$store->nickname]) }}">Create</a></li>
                        
                        @if (isset($product->id))
                        <li><a href="{{ route('manage.products.edit',[$store->nickname, $product->id]) }}">Edit</a></li>
                        @endif
                    </ul>
                </li>

                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Mis ventas <span class="label label-rouded label-themecolor pull-right">8</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('manage.orders',[$store->nickname]) }}">Todos</a></li>

                    
                    </ul>
                </li>
               

                {{-- Ejemplo de menu escalonado --}}
                {{-- <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Mis ventas <span class="label label-rouded label-themecolor pull-right">8</span></span></a>
                    <ul aria-expanded="false" class="collapse">

                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('manage.orders',[$store->nickname]) }}">Todos</a></li>

                        </ul>

                        <li><a class="has-arrow" href="#" aria-expanded="false">Mis ventas</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('manage.orders',[$store->nickname]) }}">Todos</a></li>

                            
                            </ul>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>