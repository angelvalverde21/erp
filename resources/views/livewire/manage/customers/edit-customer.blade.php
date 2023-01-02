<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @push('script-header')
        <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    @endpush

    <x-breadcrumbs title="{{ $user->name }}" icon="fa-solid fa-user" />

    
    <x-sectioncontent>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-dollar-sign"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Compras</span>
                  <span class="info-box-number">
                    
                    S/.
                    {{ $user->totalOrderMount() }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Compras Canceladas</span>
                  <span class="info-box-number">{{ $user->totalOrders() }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
  
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
  
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                
                <div class="info-box-content">
                  <span class="info-box-text">Compras concretadas</span>
                  <span class="info-box-number">{{ $user->totalOrders() }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-calendar-days"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Miembre desde</span>
                  <span class="info-box-number">{{ $user->created_at }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
    </x-sectioncontent>



    <x-sectioncontent>

        <div class="row">
            <div class="col-lg-6 col-12">
                {{-- @livewire('components.addresses.show-address-all', ['user' => $user->id, 'model_refer' => 'User', 'model_refer_id' => $user->id], key('show-addresses-store-' . $store->id)) --}}
                {{-- @livewire('components.addresses.show-address', ['address' => $user->address_id, 'model_refer'=>'User', 'model_refer_id'=>$user->id], key('show-address-customer-' . $user->address_id)) --}}
                
            </div>
            <div class="col-lg-6 col-12"></div>
        </div>

    </x-sectioncontent>

    <x-sectioncontent>
         <!-- TABLE: LATEST ORDERS -->
         <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Monto</th>
                    <th>Status</th>
                    <th>Actualizado</th>
                    <th>Ir</th>
                  </tr>
                  </thead>
                  <tbody>

                    @foreach ($orders as $order)
                  <tr>
                    <td><a href="pages/examples/invoice.html">{{ $order->id }}</a></td>
                    <td>{{ $order->total_mount }}</td>
                    <td><span class="badge badge-success">Shipped</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $order->updated_at }}</div>
                    </td>
                    <td>
                        <div class="d-flex  justify-content-center">
                            <a href="{{ route('manage.orders.edit', [$store->nickname, $order->id]) }}"
                                class="btn btn-success mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="btn btn-secondary"><i
                                    class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                  {{-- <tr>
                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>iPhone 6 Plus</td>
                    <td><span class="badge badge-danger">Delivered</span></td>
                    <td>
                      <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                    <td>Samsung Smart TV</td>
                    <td><span class="badge badge-info">Processing</span></td>
                    <td>
                      <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                    </td>
                  </tr> --}}

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
    </x-sectioncontent>
    {{-- <x-sectioncontent>
        <div class="card">

            <div class="card-body table-responsive">

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Nombre</th>

                            <th>Monto</th>
                            <th>Status</th>
                            <th>cliente desde</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>

                                <td>{{ $order->buyer->name }}</td>

                                <td>{{ $order->total_mount }}</td>
                                <td>ENTREGADO</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{ route('manage.orders.edit', [$store->nickname, $order->id]) }}"
                                            class="btn btn-success mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" class="btn btn-secondary"><i
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

    </x-sectioncontent> --}}


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
