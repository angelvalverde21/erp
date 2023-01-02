<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ventas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user') }}">Home</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    {{-- incio de modal para la creacion de venta --}}
                        @livewire('user.sales.create-sale-modal', ['user' => $sales], key('show-create-modal')) 
                    {{-- fin de modal para la creacion de venta --}}

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- inicio de bucle para mostrar ventas --}}

            <div class="row">

                <div class="col">
                    
                    @if (count($sales) > 0)

                        <div class="card">
                            <div class="card-body">

                                <table class="table table-bordered table-hover table-striped">

                                    <thead>
                                        <tr>
                                            <th role="button" class="text-center">
                                                <span>id</span> <i class="fas fa-sort"></i>
                                            </th>
                                            <th role="button" class="text-center">Cliente <i class="fas fa-sort"></i>
                                            </th>
                                            <th role="button">Entregado por <i
                                                    class="fas fa-sort"></i>
                                            </th>
                                            <th role="button">Estado del pedido<i
                                                    class="fas fa-sort"></i>
                                            </th>
                                 
                                            <th role="button">Total<i
                                                class="fas fa-sort"></i>
                                        </th>

                                            <th role="button" wire:click="order('created_at')">Fecha</th>
                                            <th role="button" wire:click="order('updated_at')">Actualizacion</th>
                                            <th class="text-center">Edit</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        @foreach ($sales as $sale)

                                        {{-- {{ $sale }} --}}

                                            <tr>
                                                <td class="text-center">{{ $sale->id }} </td>
                                                <td class="text-center">
                                                    {{ $sale->buyer->name}}
                                                </td>
                                                <td class="text-center">
                                                    {{ $sale->delivery_man->name}}
                                                </td>
                                                <td>{{ $sale->price }}</td>
                                                <td>{{ $sale->created_at }}</td>
                                                <td>{{ $sale->created_at }}</td>
                                                <td>{{ $sale->updated_at }}</td>
                                                <td class="text-center">
                                                    <a
                                                        href="{{ route('user.sales') . '/' . $sale->id . '/edit' }}"><span
                                                            style="color: grey; font-size: 25px;"><i
                                                                class="fa-solid fa-pen-to-square"></i></span></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{-- {{ $sales->links() }} --}}

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    @else
                        No se encontro ventas 
                    @endif
                </div>

            </div>


            {{-- fin de bucle para mostrar ventas --}}

        </div>
    </section>

</div>
