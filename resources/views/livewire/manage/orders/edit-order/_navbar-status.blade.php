<x-sectioncontent>
    <div class="mx-auto col-sm-6 pt-3">
        <style>
            .progress {
                height: 1.5rem !important;
                border-radius: .5rem;
                font-size: 0.9rem;
            }
        </style>

    </div>

    <div class="text-center">
        <span class="text-success">PAGO CONFIRMADO</span>
        {{-- {{ $order->status->name }} --}}
    </div>

    <div class="row">
        <div class="col-lg-9 col-sm-9 col-12 mx-auto">
            <a href="#" data-toggle="modal" data-target="#showOrderStatus">
                <div class="progress">
                    @if ($order->payment_method->name == 'contra_entrega')
                        <div class="progress-bar @if ($order->consultarStatus('preparando_envio')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-print"></i></div>
                        <div class="progress-bar @if ($order->consultarStatus('listo_para_envio')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-box"></i></div>
                        <div class="progress-bar @if ($order->consultarStatus('en_transito')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-motorcycle"></i></div>
                        <div class="progress-bar @if ($order->consultarStatus('entregado')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 25%" aria-valuenow="20" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-circle-check"></i></div>
                    @endif

                    @if ($order->payment_method->name == 'previo_deposito')
                        <div class="progress-bar @if ($order->consultarStatus('pago_confirmado')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 20%" aria-valuenow="15" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-comments-dollar"></i></div>
                        <div class="progress-bar @if ($order->consultarStatus('preparando_envio')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 20%" aria-valuenow="30" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-print"></i></div>
                        <div class="progress-bar @if ($order->consultarStatus('listo_para_envio')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-box"></i></div>
                        <div class="progress-bar @if ($order->consultarStatus('en_transito')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-motorcycle"></i></div>
                        <div class="progress-bar @if ($order->consultarStatus('entregado')) bg-success @else bg-secondary @endif progress-bar-striped"
                            role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                            aria-valuemax="100"><i class="fa-solid fa-circle-check"></i></div>
                    @endif
                </div>
            </a>

        </div>
    </div>

    {{ $order->consultarStatus('preparando_envio') }}


    {{-- <div class="text-center">
        Preparando para el envio
        
      </div> --}}

    <x-user.modal title="Estatus del pedido" id="showOrderStatus" size="modal-lg">

        {{-- @livewire('user.sales.edit-sale.carriers.show-carrier-all', ['order' => $order], key('show-carrier-all-' . $order->id)) --}}

        <div class="col-12 col-lg-12">

            <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 10px">#</th>
                                <th>Status</th>
                                <th>Progreso</th>

                                <th>Creado</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($order->status as $status)
                                <tr>
                                    <td>{{ $loop->index }}</td>
                                    <td>{{ $status->pivot->id }}</td>
                                    <td>{{ $status->title }}</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>

                                    <td>{{ $status->pivot->created_at }}</td>
                                </tr>
                            @endforeach
                            {{-- 

                    <tr>
                    <td>2.</td>
                    <td>Clean database</td>
                    <td>
                        <div class="progress progress-xs">
                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-warning">70%</span></td>
                    </tr>
                    <tr>
                    <td>3.</td>
                    <td>Cron job running</td>
                    <td>
                        <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-primary">30%</span></td>
                    </tr>
                    <tr>
                    <td>4.</td>
                    <td>Fix and squish bugs</td>
                    <td>
                        <div class="progress progress-xs progress-striped active">
                        <div class="progress-bar bg-success" style="width: 90%"></div>
                        </div>
                    </td>
                    <td><span class="badge bg-success">90%</span></td>
                    </tr> --}}
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>


        <x-slot name="footer">

        </x-slot>

    </x-user.modal>


</x-sectioncontent>
